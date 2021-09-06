<?php

use Illuminate\Support\Facades\Route;
use App\Wallet\WalletAPI\Http\Controllers\NchlControllers\NCHLController;
use App\Wallet\WalletAPI\Http\Controllers\PaypointController\PaypointController;
use App\Wallet\WalletAPI\Http\Controllers\NchlControllers\NchlAggregatedController;
use App\Wallet\WalletAPI\Http\Controllers\NonRealTimeBankTransferController\NonRealTimeBankTransferController;

Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {

    //NCHL Bank Transfer
    Route::post('/transaction/nchl/report/{id}', [NCHLController::class, 'byId'])->name('nchlBankTransferApi.report');
    Route::get('/transaction/nchl/report/compare', [NCHLController::class, 'compareTransactions'])->name('nchlBankTransferApi.compare');

    //NCHL Aggregated Transfer
    Route::post('/transaction/nchl/aggregated/report/{id}', [NchlAggregatedController::class, 'byId'])->name('nchlAggregatedTransferApi.report');
    Route::get('/transaction/nchl/aggregated/report/compare', [NchlAggregatedController::class, 'compareTransactions'])->name('nchlAggregatedTransferApi.compare');

    //Paypoint Bank Transfer
    Route::post('/transaction/paypoint/report/{id}', [PaypointController::class, 'byId'])->name('paypointTransferApi.report');
    Route::get('/transaction/paypoint/report/compare', [PaypointController::class, 'compareTransactions'])->name('paypointTransferApi.compare');

    //Non real time bank transfer
    Route::get('/non-real-time-bank-transfer',[NonRealTimeBankTransferController::class,'index'])->name('nonRealTime.index');
    Route::post('/non-real-time-branch-list',[NonRealTimeBankTransferController::class,'getBranchList'])->name('nonRealTime.branchList');
    Route::post('/process-non-real-time-bank-transfer',[NonRealTimeBankTransferController::class,'processBankRequest'])->name('nonRealTime.process');
    Route::get('/view-non-real-time-bank-transfer',[NonRealTimeBankTransferController::class,'viewNonBankTransferRequest'])->name('nonRealTime.view');
    Route::post('/check-non-real-time-bank-transfer-status/{transactionId}',[NonRealTimeBankTransferController::class,'checkStatus'])->name('nonRealTime.check');


});

//Route::post('/nchl/transaction/report/{id}', [PaypointController::class, 'byId'])->name('walletapi.report');



