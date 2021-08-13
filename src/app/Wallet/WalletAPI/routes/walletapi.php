<?php

use Illuminate\Support\Facades\Route;
use App\Wallet\WalletAPI\Http\Controllers\WalletAPIController;
use App\Wallet\WalletAPI\Http\Controllers\NCHLController;


Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {

    //WalletAPI
//    Route::get('wallet-api', [WalletAPIController::class, 'view'])->name('walletapi.view');
    Route::post('/nchl/transaction/report/{id}', [NCHLController::class, 'byId'])->name('walletapi.report');

});

//Route::post('/nchl/transaction/report/{id}', [NCHLController::class, 'byId'])->name('walletapi.report');



