<?php


namespace App\Wallet\NPSAccountLinkLoad;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class NPSAccountLinkLoadServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/NPSAccountLinkLoad.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'NPSAccountLinkLoad');
    }

}
