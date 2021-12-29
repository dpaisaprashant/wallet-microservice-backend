<?php


namespace App\Wallet\TransactionClearance;


use App\Wallet\TransactionClearance\Clearance\contracts\ClearanceRepositoryContract;
use App\Wallet\TransactionClearance\Clearance\Repository\PreTransactionClearanceRepositoryContract;
use App\Wallet\TransactionClearance\Clearance\Repository\TransactionEventClearanceRepositoryContract;
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
        //$this->app->bind(ClearanceRepositoryContract::class, TransactionEventClearanceRepositoryContract::class);
        $this->app->bind(ClearanceRepositoryContract::class, PreTransactionClearanceRepositoryContract::class);
    }

}
