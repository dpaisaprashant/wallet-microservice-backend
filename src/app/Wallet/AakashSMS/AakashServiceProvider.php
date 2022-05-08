<?php

namespace App\Wallet\AakashSMS;

use Illuminate\Support\ServiceProvider;

class AakashServiceProvider extends ServiceProvider
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
        if (!class_exists('CreateAakashSMSTable')) {
            $this->publishes([
                __DIR__ . '/database/migrations/create_aakash_smses_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_aakash_smses_table.php'),
            ], 'migrations');
        }

        $this->publishes([
            __DIR__.'/../config/aakash-sms.php' => config_path('aakash-sms.php'),
        ], 'config');
    }
}
