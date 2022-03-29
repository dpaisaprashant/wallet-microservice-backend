<?php

use App\Wallet\ManualRefund\Http\Controllers\ManualRefundController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {
   Route::match(['get', 'post'],'/manual-refund',[ManualRefundController::class,'ManualRefund'])->name('refund.manual_refund'); //todo: add middleware
});
