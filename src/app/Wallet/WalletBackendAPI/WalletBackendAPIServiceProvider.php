<?php


namespace App\Wallet\WalletBackendAPI;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class WalletBackendAPIServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'BackendAPI');
    }

}
