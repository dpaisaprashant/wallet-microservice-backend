<?php


namespace App\Wallet\Referral;


use Illuminate\Support\ServiceProvider;

class ReferralServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/referral.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Referral');
    }
}
