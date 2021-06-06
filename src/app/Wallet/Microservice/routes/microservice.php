<?php

use App\Wallet\Report\Http\Controllers\NRBReportController;
use App\Wallet\Report\Http\Controllers\SubscriberReportController;
use App\Wallet\Report\Http\Controllers\UserWalletReportController;
use App\Wallet\Report\Http\Controllers\WalletReportController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/microservice', 'middleware' => ['web','auth']], function () {

});
