<?php


namespace App\Wallet\UserProfile;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class UserProfileServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/userProfile.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'UserProfile');
    }

}
