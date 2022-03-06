<?php

use App\Http\Controllers\ExcelExportController;
use App\Http\Controllers\PhpSpreadSheetController;
use App\Wallet\Report\Http\Controllers\ClosingBalanceController;
use App\Wallet\Report\Http\Controllers\MiscReportController;
use App\Wallet\Report\Http\Controllers\NRBAnnexReportController;
use App\Wallet\Report\Http\Controllers\NRBReportController;
use App\Wallet\Report\Http\Controllers\SubscriberReportController;
use App\Wallet\Report\Http\Controllers\UserRegisteredByUserController;
use App\Wallet\Report\Http\Controllers\UserWalletReportController;
use App\Wallet\Report\Http\Controllers\WalletReportController;
use App\Wallet\Report\Http\Controllers\AdminKycController;
use App\Wallet\Report\Http\Controllers\MismatchedUserBalanceController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/report', 'middleware' => ['web', 'auth']], function () {

    Route::match(['get', 'post'], 'reconciliation-report', [WalletReportController::class, 'reconciliationReport'])->name('report.reconciliation')->middleware('permission:Report reconciliation');
    Route::match(['get', 'post'], 'reconciliation-range-report', [WalletReportController::class, 'reconciliationRangeReport'])->name('report.range.reconciliation')->middleware('permission:Report reconciliation');
    Route::match(['get', 'post'], 'wallet-ledger', [WalletReportController::class, 'walletLedger'])->name('report.range.wallet_ledger')->middleware('permission:Report reconciliation');


    Route::match(['get', 'post'], 'daily-dashboard', [WalletReportController::class, 'dailyDashboard'])->name('report.dailyDashboard')->middleware('permission:Report reconciliation');


    Route::match(['get', 'post'], 'users-reconciliation-report', [UserWalletReportController::class, 'userReconciliationReport'])->name('report.user.reconciliation');

    Route::match(['get', 'post'], 'customer-activity-report', [WalletReportController::class, 'customerActivityReport'])->name('report.clientActivity');

    Route::match(['get', 'post'], 'nchl-load-report', [WalletReportController::class, 'nchlLoadReport'])->name('report.nchl.load')->middleware('permission:Report nchl load');

    Route::get('subscriber-daily-report', [SubscriberReportController::class, 'subscriberDailyReport'])->name('report.subscriber')->middleware('permission:Report subscriber daily');

    //NRB Report
    Route::get('nrb/active-user-report', [NRBReportController::class, 'activeCustomerReport'])->name('report.nrb.activeUser')->middleware('permission:Report nrb active and inactive user');
    Route::get('nrb/inactive-user-report', [NRBReportController::class, 'inactiveCustomerReport'])->name('report.nrb.inactiveUser')->middleware('permission:Report nrb active and inactive user');

    //Active inactive transaction counts
    Route::get('nrb/active-inactive-user-transaction-report', [NRBReportController::class, 'activeInactiveTransaction'])->name('report.nrb.activeInactiveTransaction')->middleware('permission:Report nrb active and inactive user');

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

    //closing balance
    Route::get('closing-balance', [ClosingBalanceController::class, 'getClosingBalanceReport'])->name('report.closing.balance');

    /**
     * NRB ANNEX Report
     */
    //10.1.5 Report
    Route::get('nrb-annex/agent-payments', [NRBAnnexReportController::class, 'agentReport'])->name('report.nrb.annex.agent.payments')->middleware('permission:Nrb annex report view');
    Route::get('nrb-annex/customer-payments', [NRBAnnexReportController::class, 'customerReport'])->name('report.nrb.annex.customer.payments')->middleware('permission:Nrb annex report view');
//    Route::get('nrb-annex/customer-payments-details', [NRBAnnexReportController::class, 'customerReportDetails'])->name('report.nrb.annex.customer.payments.details');

    //10.1.6 Report
    Route::get('nrb-annex/merchant-payments', [NRBAnnexReportController::class, 'merchantReport'])->name('report.nrb.annex.merchant.payments')->middleware('permission:Nrb annex report view');

    //Statement Settlement Bank Report
    Route::get('nrb-annex/statement-settlement-bank', [NRBAnnexReportController::class, 'statementSettlementBank'])->name('report.statement.settlement.bank')->middleware('permission:Nrb annex report view');
    Route::post('nrb-annex/statement-settlement-bank/delete/{id}', [NRBAnnexReportController::class, 'statementSettlementBankReportDelete'])->name('report.statement.settlement.bank.delete')->middleware('permission:Nrb annex report view');
    Route::get('nrb-annex/statement-settlement-bank/generated', [NRBAnnexReportController::class, 'statementSettlementBankReportGenerated'])->name('report.statement.settlement.bank.generated')->middleware('permission:Nrb annex report view');
    Route::get('nrb-annex/statement-settlement-bank/excel', [PhpSpreadSheetController::class, 'statementSettlementBankReport'])->name('report.statement.settlement.bank.excel')->middleware('permission:Nrb annex report view');


    //Active Inactive
    Route::get('nrb-report/active-inactive', [NRBReportController::class, 'activeInactiveUserReport'])->name('report.active.inactive.user')->middleware('permission:Nrb annex report view');
    Route::post('nrb-report/active-inactive/delete/{id}', [NRBReportController::class, 'activeInactiveUserReportDelete'])->name('report.active.inactive.user.delete')->middleware('permission:Nrb annex report view');
    Route::get('nrb-report/active-inactive/generated', [NRBReportController::class, 'activeInactiveUserReportGenerated'])->name('report.active.inactive.user.generated')->middleware('permission:Nrb annex report view');
    Route::get('nrb-report/active-inactive/excel', [PhpSpreadSheetController::class, 'activeInactiveUserReport'])->name('report.active.inactive.user.excel')->middleware('permission:Nrb annex report view');

    //Active Inactive w/ Amount
    Route::get('nrb-report/active-inactive-slab', [NRBReportController::class, 'activeInactiveUserSlabReport'])->name('report.active.inactive.user.slab')->middleware('permission:Nrb annex report view');
    Route::post('nrb-report/active-inactive-slab/delete/{id}', [NRBReportController::class, 'activeInactiveUserSlabReportDelete'])->name('report.active.inactive.user.slab.delete')->middleware('permission:Nrb annex report view');
    Route::get('nrb-report/active-inactive-slab/generated', [NRBReportController::class, 'activeInactiveUserSlabReportGenerated'])->name('report.active.inactive.user.slab.generated')->middleware('permission:Nrb annex report view');
    Route::get('nrb-report/active-inactive-slab/excel', [PhpSpreadSheetController::class, 'activeInactiveUserSlabReport'])->name('report.active.inactive.user.slab.excel')->middleware('permission:Nrb annex report view');

    //NRB Recon Report
    Route::get('nrb-report/nrb-reconciliation', [NRBReportController::class, 'reconciliationReport'])->name('report.nrb.annex.reconciliation')->middleware('permission:Nrb annex report view');
//    Route::get('nrb-report/nrb-reconciliation/delete/{id}', [NRBReportController::class, 'reconciliationReportDelete'])->name('report.nrb.annex.reconciliation.delete')->middleware('permission:Nrb annex report view');
//    Route::get('nrb-report/nrb-reconciliation/generated', [NRBReportController::class, 'reconciliationReportGenerated'])->name('report.nrb.annex.reconciliation.generated')->middleware('permission:Nrb annex report view');

    //10.1.11 Report
    Route::get('nrb-report/agent-payment-report', [NRBAnnexReportController::class, 'agentPaymentReport'])->name('report.nrb.annex.agent.payment')->middleware('permission:Nrb annex report view');;
    Route::post('nrb-report/agent-payment-report/delete/{fromDate}/{toDate}', [NRBAnnexReportController::class, 'agentPaymentReportDelete'])->name('report.nrb.annex.agent.payment.delete')->middleware('permission:Nrb annex report view');
    Route::get('nrb-report/agent-payment-report/generated', [NRBAnnexReportController::class, 'agentPaymentReportGenerated'])->name('report.nrb.annex.agent.payment.generated')->middleware('permission:Nrb annex report view');
    Route::get('nrb-report/agent-payment-report/excel', [PhpSpreadSheetController::class, 'nrbAgentReport'])->name('report.nrb.annex.agent.payment.excel')->middleware('permission:Nrb annex report view');

    //    Route::get('nrb-report/agent-10.1.6', [NRBAnnexReportController::class, 'agentMerchantReport'])->name('report.nrb.annex.agent.10.1.6')->middleware('permission:Nrb annex report view');;

    Route::get('nrb-report/agent-report-each', [NRBAnnexReportController::class, 'eachAgentReport'])->name('report.nrb.annex.agent.each')->middleware('permission:Nrb annex report view');;
    Route::post('nrb-report/agent-report-each/delete/{id}', [NRBAnnexReportController::class, 'eachAgentReportDelete'])->name('report.nrb.annex.agent.each.delete')->middleware('permission:Nrb annex report view');
    Route::get('nrb-report/agent-report-each/generated', [NRBAnnexReportController::class, 'eachAgentReportGenerated'])->name('report.nrb.annex.agent.each.generated')->middleware('permission:Nrb annex report view');

    //    Route::get('/report/nrb-annex/agent-payments/monthly', 'ReportController@monthly')->name('report.monthly')->middleware('permission:Monthly report view');
//    Route::get('/report/yearly', 'ReportController@yearly')->name('report.yearly')->middleware('permission:Yearly report view');

    /**
     * Lucky Winner Report
     */

    Route::get('lucky-winners', [MiscReportController::class, 'luckyWinnerReport'])->name('report.lucky.winner');
    Route::get('ticket-sales', [MiscReportController::class, 'ticketSalesReport'])->name('report.ticket.sale');


    /**
     * User Registered By User Report
     */

    Route::get('user-registered-by-user',[UserRegisteredByUserController::class,'report'])->name('report.user-registered-by-user')->middleware('permission:Report user registered by user');
    Route::get('user-registered-by-user/excel',[ExcelExportController::class,'userRegisteredByUserReport'])->name('report.user-registered-by-user.excel')->middleware('permission:Report user registered by user');
});
