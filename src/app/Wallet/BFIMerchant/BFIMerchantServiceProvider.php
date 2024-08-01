<?php


namespace App\Wallet\BFIMerchant;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BFIMerchantServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/bfi.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'BFIMerchant');
    }

}
