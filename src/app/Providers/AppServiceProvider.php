<?php

namespace App\Providers;

use App\Models\UserKYC;
use App\Observers\AcceptKYCUserKYCObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        UserKYC::observe(AcceptKYCUserKYCObserver::class);
    }
}
