<?php


namespace App\Wallet\WalletRegistration;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class WalletRegistrationServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/walletregistration.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'WalletRegistration');
    }

}
