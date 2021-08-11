<?php

use Illuminate\Support\Facades\Route;
use App\Wallet\WalletAPI\Http\Controllers\WalletAPIController;


Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {

    //WalletAPI
    Route::get('wallet-api', [WalletAPIController::class, 'view'])->name('walletapi.view');


});

//User Bank Account
Route::group(["middleware" => [ "user-status", CustomHeaderVerifier::class, "json.response", "throttle:ip"] ], function() {

    Route::get('/user-bank-account', 'NCHL\UserBankAccountController@viewAll');
    Route::get('/user-bank-account/{account_id}', 'NCHL\UserBankAccountController@view');
    Route::post('/user-bank-account', 'NCHL\UserBankAccountController@store')->middleware("checkUserType:user");
    Route::put('/user-bank-account/{account_id}', 'NCHL\UserBankAccountController@update')->middleware("checkUserType:user");
    Route::delete('/user-bank-account/{account_id}', 'NCHL\UserBankAccountController@delete')->middleware("checkUserType:user");


    Route::post('/nchl-bank-list', 'NCHL\NchlBankTransferController@bankList');
    Route::post('/nchl-branch-list/{bank_id}', 'NCHL\NchlBankTransferController@branchList');

    Route::post('/nchl/process-bank-transfer', 'NCHL\NchlBankTransferController@process')->middleware('holdBalance', 'checkUserType:user');

    Route::get('transactions/nchl-bank-transfer/{id}', 'NCHL\NchlBankTransferController@successfulTransaction')->middleware('json.response');

    Route::post('/nchl/transaction/report', [NchlReportController::class, 'byId']);
});
