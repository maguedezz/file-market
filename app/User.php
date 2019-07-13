<?php

namespace App;

use App\Traits\Roles\HasRoles;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use  HasRoles, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'stripe_id' , 'stripe_key'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function saleValueThisMonth() // need a query in the database
    {
        $now = Carbon::now(); // tba to use laravel's query builder
        // can't access as a property cuz we are using a query builder down here.
        return $this->sales()->whereBetween('created_at', [
            $now->startOfMonth(),
            $now->copy()->endOfMonth()
        ])->get()->sum('sale_price');
    }

    public function saleValueOverLifeTime()
    {
       return $this->sales->sum('sale_price');
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isTheSameAs(User $user)
    {
        return $this->id === $user->id;
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

}
