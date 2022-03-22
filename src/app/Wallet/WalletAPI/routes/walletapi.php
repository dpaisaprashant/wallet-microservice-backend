<?php

use App\Http\Controllers\ExcelExportController;
use Illuminate\Support\Facades\Route;
use App\Wallet\WalletAPI\Http\Controllers\NchlControllers\NCHLController;
use App\Wallet\WalletAPI\Http\Controllers\PaypointController\PaypointController;
use App\Wallet\WalletAPI\Http\Controllers\NchlControllers\NchlAggregatedController;
use App\Wallet\WalletAPI\Http\Controllers\NonRealTimeBankTransferController\NonRealTimeBankTransferController;

Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {

    //NCHL Bank Transfer
    Route::post('/transaction/nchl/report/{id}', [NCHLController::class, 'byId'])->name('nchlBankTransferApi.report')->middleware('permission:View nchl api');
    Route::get('/transaction/nchl/report/compare', [NCHLController::class, 'compareTransactions'])->name('nchlBankTransferApi.compare')->middleware('permission:View nchl api');
//    Route::post('/transaction/nchl/report/by-date', [NCHLController::class, 'byDate'])->name('nchlBankTransferApiByDate.report');


    //NCHL Aggregated Transfer
    Route::post('/transaction/nchl/aggregated/report/{id}', [NchlAggregatedController::class, 'byId'])->name('nchlAggregatedTransferApi.report')->middleware('permission:View nchl aggregated api');
    Route::get('/transaction/nchl/aggregated/report/compare', [NchlAggregatedController::class, 'compareTransactions'])->name('nchlAggregatedTransferApi.compare')->middleware('permission:View nchl aggregated api');
//    Route::post('/transaction/nchl/aggregated/report/by-date', [NchlAggregatedController::class, 'byDate'])->name('nchlAggregatedTransferApiByDate.report');

    //Paypoint Bank Transfer
    Route::post('/transaction/paypoint/report/{id}', [PaypointController::class, 'byId'])->name('paypointTransferApi.report')->middleware('permission:View paypoint api');
    Route::get('/transaction/paypoint/report/compare', [PaypointController::class, 'compareTransactions'])->name('paypointTransferApi.compare')->middleware('permission:View paypoint api');

    //Non real time bank transfer
    Route::get('/non-real-time-bank-transfer',[NonRealTimeBankTransferController::class,'index'])->name('nonRealTime.index');
    Route::post('/non-real-time-branch-list',[NonRealTimeBankTransferController::class,'getBranchList'])->name('nonRealTime.branchList');
    Route::post('/process-non-real-time-bank-transfer',[NonRealTimeBankTransferController::class,'processBankRequest'])->name('nonRealTime.process');
    Route::get('/view-non-real-time-bank-transfer',[NonRealTimeBankTransferController::class,'viewNonBankTransferRequest'])->name('nonRealTime.view');
    Route::post('/check-non-real-time-bank-transfer-status/{transactionId}',[NonRealTimeBankTransferController::class,'checkStatus'])->name('nonRealTime.check');

    //Excel
    Route::get('/non-real-time-bank-transfer/excel',[ExcelExportController::class,'nonRealTimeBankTransfer'])->name('nonRealTime.excel');


});




