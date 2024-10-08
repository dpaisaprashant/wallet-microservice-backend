<?php

namespace App\Wallet\MiracleInfoSMS\routes;
use Illuminate\Support\Facades\Route;
use App\Wallet\MiracleInfoSMS\Http\Controllers\MiracleInfoSmsController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'web','auth'], function() {
        Route::match(['get', 'post'], '/miracle-info-sms', [MiracleInfoSmsController::class, 'index'])->name('miracle-info.view');
    });
});
