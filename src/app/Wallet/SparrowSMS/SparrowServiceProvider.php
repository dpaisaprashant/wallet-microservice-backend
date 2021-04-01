<?php

namespace App\Wallet\SparrowSMS;

use Illuminate\Support\ServiceProvider;

class SparrowServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (!class_exists('CreateSparrowTable')) {
            $this->publishes([
                __DIR__ . '/database/migrations/create_sparrow_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_sparrow_table.php'),
            ], 'migrations');
        }

        $this->publishes([
            __DIR__.'/../config/sparrow-sms.php' => config_path('sparrow-sms.php'),
        ], 'config');
    }
}
