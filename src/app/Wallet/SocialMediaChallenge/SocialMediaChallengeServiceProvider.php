<?php


namespace App\Wallet\SocialMediaChallenge;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SocialMediaChallengeServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/socialmediachallenge.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'SocialMediaChallenge');
    }

}
