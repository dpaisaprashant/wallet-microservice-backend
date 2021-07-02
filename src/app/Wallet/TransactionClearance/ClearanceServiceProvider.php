<?php


namespace App\Wallet\TransactionClearance;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ClearanceServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/clearance.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Clearance');
    }

}
