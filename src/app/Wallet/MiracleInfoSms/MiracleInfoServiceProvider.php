<?php


namespace App\Wallet\MiracleInfoSms;


use Carbon\Laravel\ServiceProvider;

class MiracleInfoServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/MiracleInfoSms.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'MiracleInfoSms');
    }
}
