<?php

namespace App\Wallet\SystemRepost;

use Illuminate\Support\ServiceProvider;

class SystemRepostServiceProvider extends ServiceProvider
{

    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/systemRepost.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'SystemRepost');
    }

}
