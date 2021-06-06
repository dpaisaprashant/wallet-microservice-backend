<?php


namespace App\Wallet\Microservice;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MicroserviceServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/microservice.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Microservice');
    }

}
