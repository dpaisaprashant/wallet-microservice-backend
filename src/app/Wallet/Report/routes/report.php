<?php

use App\Wallet\Report\Http\Controllers\NRBReportController;
use App\Wallet\Report\Http\Controllers\SubscriberReportController;
use App\Wallet\Report\Http\Controllers\UserWalletReportController;
use App\Wallet\Report\Http\Controllers\WalletReportController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/report', 'middleware' => ['web','auth']], function () {

    Route::match(['get', 'post'],'reconciliation-report', [WalletReportController::class, 'reconciliationReport'])->name('report.reconciliation');
    Route::match(['get', 'post'],'users-reconciliation-report', [UserWalletReportController::class, 'userReconciliationReport'])->name('report.user.reconciliation');

    Route::match(['get', 'post'],'customer-activity-report', [WalletReportController::class, 'customerActivityReport'])->name('report.clientActivity');

    Route::match(['get', 'post'],'nchl-load-report', [WalletReportController::class, 'nchlLoadReport'])->name('report.nchl.load');

    Route::get('subscriber-daily-report', [SubscriberReportController::class, 'subscriberDailyReport'])->name('report.subscriber');

    //NRB Report
    Route::get('nrb/active-inactive-user-report', [NRBReportController::class, 'activeInactiveCustomerReport'])->name('report.nrb.activeInactiveUser');
    Route::get('nrb/agent-report', [NRBReportController::class, 'agentReport'])->name('report.agent');

    //Non bank payment
    Route::get('/non-bank-payment',[NRBReportController::class,'nonBankPaymentReport'])->name('report.nonBankPaymentReport');
});
