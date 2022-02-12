<?php

namespace App\Wallet\BonusToMainBalanceTransfer;

use Carbon\Laravel\ServiceProvider;

class BonusToMainBalanceTransferServiceProvider extends ServiceProvider
{

    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/BonusToMainBalanceTransfer.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'BonusToMainBalanceTransfer');
    }
}
