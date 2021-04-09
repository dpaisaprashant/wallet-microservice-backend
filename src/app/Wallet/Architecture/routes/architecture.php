<?php

use App\Wallet\Architecture\Http\Controllers\WalletTransactionCashbackController;
use App\Wallet\Architecture\Http\Controllers\WalletTransactionCommissionController;
use App\Wallet\Architecture\Http\Controllers\WalletTransactionTypeController;
use App\Wallet\Architecture\Http\Controllers\WalletUserCashbackController;
use App\Wallet\Architecture\Http\Controllers\WalletUserCommissionController;
use App\Wallet\Referral\Http\Controllers\ReferralController;
use App\Wallet\Referral\Http\Controllers\ReferralSchemaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/architecture', 'middleware' => ['web','auth']], function () {
    Route::get('/vendor-transactions/{vendorName}', [WalletTransactionTypeController::class, 'vendorTransactions'])->name('architecture.vendor.transaction');

    //GET USER TYPE LISTS
    Route::post('/get-user-type-lists', [WalletTransactionTypeController::class, 'getUserTransactionTypeList'])->name('architecture.userType.list');
    Route::post('/get-user-lists', [WalletTransactionTypeController::class, 'getUserList'])->name('architecture.user.list');

    //TRANSACTION CASHBACK
    //Create transaction cashback
    Route::get('/wallet-transaction-cashbacks/{walletTransaction}', [WalletTransactionCashbackController::class, 'index'])->name('architecture.transaction.cashback');
    Route::match(['get', 'post'], '/wallet-transaction-cashbacks/{walletTransaction}/create', [WalletTransactionCashbackController::class, 'create'])->name('architecture.transaction.cashback.create');
    Route::match(['get', 'post'], '/wallet-transaction-cashbacks/edit/{id}', [WalletTransactionCashbackController::class, 'update'])->name('architecture.transaction.cashback.update');
    Route::post('/wallet-transaction-cashbacks/delete', [WalletTransactionCashbackController::class, 'delete'])->name('architecture.transaction.cashback.delete');

    //Create single user cashback
    Route::get('/user-wallet-transaction-cashbacks/{walletTransaction}', [WalletUserCashbackController::class, 'index'])->name('architecture.user.cashback');
    Route::match(['get', 'post'], '/user-wallet-transaction-cashbacks/{walletTransaction}/create', [WalletUserCashbackController::class, 'create'])->name('architecture.user.cashback.create');
    Route::match(['get', 'post'], '/user-wallet-transaction-cashbacks/edit/{id}', [WalletUserCashbackController::class, 'update'])->name('architecture.user.cashback.update');
    Route::post('/user-wallet-transaction-cashbacks/delete', [WalletUserCashbackController::class, 'delete'])->name('architecture.user.cashback.delete');



    //Create transaction commission
    Route::get('/wallet-transaction-commissions/{walletTransaction}', [WalletTransactionCommissionController::class, 'index'])->name('architecture.transaction.commission');
    Route::match(['get', 'post'], '/wallet-transaction-commissions/{walletTransaction}/create', [WalletTransactionCommissionController::class, 'create'])->name('architecture.transaction.commission.create');
    Route::match(['get', 'post'], '/wallet-transaction-commissions/edit/{id}', [WalletTransactionCommissionController::class, 'update'])->name('architecture.transaction.commission.update');
    Route::post('/wallet-transaction-commissions/delete', [WalletTransactionCommissionController::class, 'delete'])->name('architecture.transaction.commission.delete');


    //Create single user commission
    Route::get('/user-wallet-transaction-commission/{walletTransaction}', [WalletUserCommissionController::class, 'index'])->name('architecture.user.commission');
    Route::match(['get', 'post'], '/user-wallet-transaction-commission/{walletTransaction}/create', [WalletUserCommissionController::class, 'create'])->name('architecture.user.commission.create');
    Route::match(['get', 'post'], '/user-wallet-transaction-commission/edit/{id}', [WalletUserCommissionController::class, 'update'])->name('architecture.user.commission.update');
    Route::post('/user-wallet-transaction-commission/delete', [WalletUserCommissionController::class, 'delete'])->name('architecture.user.commission.delete');
});
