<?php


namespace App\Wallet\CellPayUserTransaction;


use Carbon\Laravel\ServiceProvider;

class CellPayUserTransactionServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/CellPayUserTransaction.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'CellPayUserTransaction');
    }
}
