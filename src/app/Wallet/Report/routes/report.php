<?php

use App\Wallet\Report\Http\Controllers\NRBReportController;
use App\Wallet\Report\Http\Controllers\SubscriberReportController;
use App\Wallet\Report\Http\Controllers\UserWalletReportController;
use App\Wallet\Report\Http\Controllers\WalletReportController;
use App\Wallet\Report\Http\Controllers\AdminKycController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/report', 'middleware' => ['web','auth']], function () {

    Route::match(['get', 'post'],'reconciliation-report', [WalletReportController::class, 'reconciliationReport'])->name('report.reconciliation')->middleware('permission:Report reconciliation');


    Route::match(['get', 'post'],'users-reconciliation-report', [UserWalletReportController::class, 'userReconciliationReport'])->name('report.user.reconciliation');

    Route::match(['get', 'post'],'customer-activity-report', [WalletReportController::class, 'customerActivityReport'])->name('report.clientActivity');

    Route::match(['get', 'post'],'nchl-load-report', [WalletReportController::class, 'nchlLoadReport'])->name('report.nchl.load')->middleware('permission:Report nchl load');

    Route::get('subscriber-daily-report', [SubscriberReportController::class, 'subscriberDailyReport'])->name('report.subscriber')->middleware('permission:Report subscriber daily');

    //NRB Report
    Route::get('nrb/active-inactive-user-report', [NRBReportController::class, 'activeInactiveCustomerReport'])->name('report.nrb.activeInactiveUser')->middleware('permission:Report nrb active and inactive user');
    Route::get('nrb/agent-report', [NRBReportController::class, 'agentReport'])->name('report.agent')->middleware('permission:Report nrb agent');

    //Non bank payment
    Route::get('/non-bank-payment',[NRBReportController::class,'nonBankPaymentReport'])->name('report.nonBankPaymentReport')->middleware('permission:Report non bank payment');

    //AdminKyc
    Route::get('/adminKyc',[AdminKycController::class,'getAdminData'])->name('report.adminKyc')->middleware('permission:Report admin kyc');
});
