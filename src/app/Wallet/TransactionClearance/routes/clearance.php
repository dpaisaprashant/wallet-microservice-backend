<?php

use App\Wallet\Report\Http\Controllers\NRBReportController;
use App\Wallet\Report\Http\Controllers\SubscriberReportController;
use App\Wallet\Report\Http\Controllers\UserWalletReportController;
use App\Wallet\Report\Http\Controllers\WalletReportController;
use App\Wallet\Report\Http\Controllers\AdminKycController;
use App\Wallet\TransactionClearance\Http\Controllers\ClearanceController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/clearance', 'middleware' => ['web','auth']], function () {

    Route::get('/clearance-transaction-list', [ClearanceController::class, 'clearanceTransactions'])->name('clearance.transactions');
    Route::post('/clearance-generate', [ClearanceController::class, 'clearanceGenerate'])->name('clearance.generate');
    Route::get('/clearance-generate', [ClearanceController::class, 'clearanceGenerate'])->name('clearance.generate');
});
