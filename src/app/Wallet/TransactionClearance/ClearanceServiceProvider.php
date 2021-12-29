<?php


namespace App\Wallet\TransactionClearance;


use App\Wallet\TransactionClearance\Clearance\contracts\ClearanceRepository;
use App\Wallet\TransactionClearance\Clearance\Repository\PreTransactionClearanceRepository;
use App\Wallet\TransactionClearance\Clearance\Repository\TransactionEventClearanceRepository;
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
        //$this->app->bind(ClearanceRepository::class, TransactionEventClearanceRepository::class);
        $this->app->bind(ClearanceRepository::class, PreTransactionClearanceRepository::class);
    }

}
