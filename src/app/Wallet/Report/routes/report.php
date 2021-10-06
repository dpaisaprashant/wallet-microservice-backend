<?php

use App\Wallet\Report\Http\Controllers\NRBReportController;
use App\Wallet\Report\Http\Controllers\SubscriberReportController;
use App\Wallet\Report\Http\Controllers\UserWalletReportController;
use App\Wallet\Report\Http\Controllers\WalletReportController;
use App\Wallet\Report\Http\Controllers\AdminKycController;
use App\Wallet\Report\Http\Controllers\MismatchedUserBalanceController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/report', 'middleware' => ['web', 'auth']], function () {

    Route::match(['get', 'post'], 'reconciliation-report', [WalletReportController::class, 'reconciliationReport'])->name('report.reconciliation')->middleware('permission:Report reconciliation');


    Route::match(['get', 'post'], 'users-reconciliation-report', [UserWalletReportController::class, 'userReconciliationReport'])->name('report.user.reconciliation');

    Route::match(['get', 'post'], 'customer-activity-report', [WalletReportController::class, 'customerActivityReport'])->name('report.clientActivity');

    Route::match(['get', 'post'], 'nchl-load-report', [WalletReportController::class, 'nchlLoadReport'])->name('report.nchl.load')->middleware('permission:Report nchl load');

    Route::get('subscriber-daily-report', [SubscriberReportController::class, 'subscriberDailyReport'])->name('report.subscriber')->middleware('permission:Report subscriber daily');

    //NRB Report
    Route::get('nrb/active-user-report', [NRBReportController::class, 'activeCustomerReport'])->name('report.nrb.activeUser')->middleware('permission:Report nrb active and inactive user');
    Route::get('nrb/inactive-user-report', [NRBReportController::class, 'inactiveCustomerReport'])->name('report.nrb.inactiveUser')->middleware('permission:Report nrb active and inactive user');

    Route::get('nrb/agent-report', [NRBReportController::class, 'agentReport'])->name('report.agent')->middleware('permission:Report nrb agent');

    //Non bank payment
    Route::get('/non-bank-payment', [NRBReportController::class, 'nonBankPaymentReport'])->name('report.nonBankPaymentReport')->middleware('permission:Report non bank payment');
    Route::get('/non-bank-payment-count', [NRBReportController::class, 'nonBankPaymentCountReport'])->name('report.nonBankPaymentCountReport')->middleware('permission:Report non bank payment count');

    //AdminKyc
    Route::get('/adminKyc', [AdminKycController::class, 'getAdminData'])->name('report.adminKyc')->middleware('permission:Report admin kyc');

    // Mismatches user balances
    Route::match(['get', 'post'],'mismatched-user-balances', [MismatchedUserBalanceController::class, 'report'])->name('report.mismatchedUserBalance')->middleware('permission:View mismatched user balance and bonus balance');

    //Nrb Reconciliation Report
    Route::match(['get', 'post'],'nrb-reconciliation-report', [WalletReportController::class, 'nrbReconciliationReport'])->name('report.nrb.reconciliation')->middleware('permission:Report nrb reconciliation');

});
