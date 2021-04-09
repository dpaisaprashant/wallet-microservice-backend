<?php

use App\Wallet\Architecture\Http\Controllers\WalletTransactionCashbackController;
use App\Wallet\Architecture\Http\Controllers\WalletTransactionTypeController;
use App\Wallet\Architecture\Http\Controllers\WalletUserCashbackController;
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

    //Create single user commission
});
