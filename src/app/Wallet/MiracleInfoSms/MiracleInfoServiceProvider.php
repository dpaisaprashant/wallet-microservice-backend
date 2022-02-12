<?php


namespace App\Wallet\MiracleInfoSMS;


use Illuminate\Support\ServiceProvider;

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
