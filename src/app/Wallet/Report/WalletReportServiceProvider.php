<?php


namespace App\Wallet\Report;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class WalletReportServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/report.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'WalletReport');
    }

}
