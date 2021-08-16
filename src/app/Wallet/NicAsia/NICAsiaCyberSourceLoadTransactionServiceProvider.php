<?php


namespace App\Wallet\NicAsia;


use Carbon\Laravel\ServiceProvider;

class NICAsiaCyberSourceLoadTransactionServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/NICAsiaCyberSourceLoadTransaction.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'NicAsia');
    }
}
