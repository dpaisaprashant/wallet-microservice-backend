<?php


namespace App\Wallet\LinkedAccounts;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LinkedAccountsServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/LinkedAccounts.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'LinkedAccounts');
    }

}
