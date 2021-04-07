<?php

use App\Wallet\Architecture\Http\Controllers\WalletTransactionCashbackController;
use App\Wallet\Architecture\Http\Controllers\WalletTransactionTypeController;
use App\Wallet\Referral\Http\Controllers\ReferralController;
use App\Wallet\Referral\Http\Controllers\ReferralSchemaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/architecture', 'middleware' => ['web','auth']], function () {
    Route::get('/vendor-transactions/{vendorName}', [WalletTransactionTypeController::class, 'vendorTransactions'])->name('architecture.vendor.transaction');


    //TRANSACTION CASHBACK
    Route::get('/wallet-transaction-cashbacks/{walletTransaction}', [WalletTransactionCashbackController::class, 'index'])->name('architecture.trasnaction.cashback');
    Route::match(['get', 'post'], '/wallet-transaction-cashbacks/{walletTransaction}/create', [WalletTransactionCashbackController::class, 'create'])->name('architecture.trasnaction.cashback.create');
    Route::match(['get', 'post'], '/wallet-transaction-cashbacks/edit/{id}', [WalletTransactionCashbackController::class, 'update'])->name('architecture.trasnaction.cashback.update');
    Route::post('/wallet-transaction-cashbacks/delete', [WalletTransactionCashbackController::class, 'delete'])->name('architecture.trasnaction.cashback.delete');

    //Create transaction cashback
    //Create transaction commission

    //Create single user cashback
    //Create single user commission
});
