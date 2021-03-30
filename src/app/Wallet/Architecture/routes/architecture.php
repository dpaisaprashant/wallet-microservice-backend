<?php

use App\Wallet\Architecture\Http\Controllers\WalletTransactionTypeController;
use App\Wallet\Referral\Http\Controllers\ReferralController;
use App\Wallet\Referral\Http\Controllers\ReferralSchemaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/architecture', 'middleware' => ['web','auth']], function () {
    Route::get('/vendor-transactions/{vendorName}', [WalletTransactionTypeController::class, 'vendorTransactions'])->name('architecture.vendor.transaction');
});
