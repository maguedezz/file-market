<?php

namespace Tests\Unit\Models;

use App\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->user = new User;
    }
    /** @test */
    public function it_has_name_mail_password_as_fillable()
    {
        $this->assertEquals([
        'name', 'email', 'password',
    ], $this->user->getFillable());
    }
    /** @test */
    public function it_has_hidden_password_remember_token()
    {
        $this->assertEquals([
        'password', 'remember_token',
    ],  $this->user->getHidden());
    }
    /** @test */
    public function it_has_many_files_relationship()
    {
        // dd(class_basename($this->user->files())); => To determine the class name
        $this->assertInstanceOf(HasMany::class, $this->user->files());    
    }
    /** @test */
    public function it_has_many_files_relationship_with_localkey_as_id()
    {
        //getParentKey
        //getQualifiedParentKeyName
       // dd($this->user->files()->getQualifiedParentKeyName());
        $this->assertEquals('users.id',$this->user->files()->getQualifiedParentKeyName());
    }
    /** @test */
    public function it_has_many_files_relationship_with_foreignkey_as_user_id()
    {
      //  dd($this->user->files()->getQualifiedForeignKeyName());
        $this->assertEquals('files.user_id', $this->user->files()->getQualifiedForeignKeyName());
    }
    /** @test */
    public function it_matches_the_users_table_name_user()
    {
    //    dd($this->user->getTable());
        $this->assertEquals('users',$this->user->getTable());
    }
}
