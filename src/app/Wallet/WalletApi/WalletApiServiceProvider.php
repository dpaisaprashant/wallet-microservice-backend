<?php


namespace App\Wallet\WalletApi;


use Carbon\Laravel\ServiceProvider;

class WalletApiServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/WalletApi.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'WalletApi');
    }
}
