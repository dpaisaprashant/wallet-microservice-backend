<?php


namespace App\Wallet\Architecture;


use Carbon\Laravel\ServiceProvider;

class ArchitectureServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/architecture.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Architecture');
    }
}
