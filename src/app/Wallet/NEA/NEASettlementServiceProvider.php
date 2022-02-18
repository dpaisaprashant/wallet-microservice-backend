<?php


namespace App\Wallet\NEA;


use Carbon\Laravel\ServiceProvider;

class NEASettlementServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/NEASettlement.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'NEA');
    }
}
