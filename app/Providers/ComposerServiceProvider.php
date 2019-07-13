<?php

namespace App\Providers;

use App\Http\ViewComposers\{AccountStatsComposer, AdminStatsComposer};
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }


    public function boot()
    {
        View::composer('account.layouts.partials._stats', AccountStatsComposer::class);
        View::composer('admin.layouts.partials._stats', AdminStatsComposer::class);
    }
}
