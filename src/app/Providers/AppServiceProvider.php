<?php

namespace App\Providers;

use App\Models\UserKYC;
use App\Observers\AcceptKYCUserKYCObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Url;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Url::forceScheme('https');
        UserKYC::observe(AcceptKYCUserKYCObserver::class);
    }
}
