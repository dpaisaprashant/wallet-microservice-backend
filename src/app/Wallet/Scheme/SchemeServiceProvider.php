<?php


namespace App\Wallet\Scheme;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SchemeServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/scheme.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Scheme');
    }

}
