<?php


namespace App\Wallet\WalletAPI;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class WalletAPIServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/walletapi.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'WalletAPI');
    }

}
