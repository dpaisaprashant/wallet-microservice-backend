<?php

namespace App\Wallet\ManualRefund;

use Illuminate\Support\ServiceProvider;

class ManualRefundServiceProvider extends ServiceProvider
{

    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/manualRefund.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'ManualRefund');
    }

}
