<?php


namespace App\Wallet\Merchant;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MerchantServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/merchant.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Merchant');
    }

}
