<?php


namespace App\Wallet\WalletIP;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class WalletIPServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/walletip.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'WalletIP');
    }

}
