<?php


namespace App\Wallet\RefundPreTransaction;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class RefundPreTransactionServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/refundpretransaction.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'RefundPreTransaction');
    }

}
