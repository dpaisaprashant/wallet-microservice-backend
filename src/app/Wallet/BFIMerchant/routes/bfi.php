<?php

use Illuminate\Support\Facades\Route;
use App\Wallet\BFIMerchant\Http\Controllers\BFIMerchantController;
use App\Wallet\BFIMerchant\Http\Controllers\BFIUserController;
use App\Wallet\BFIMerchant\Http\Controllers\BFIPaymentExecutePaymentController;
use App\Wallet\BFIMerchant\Http\Controllers\BFIToUserFundTransferController;
use App\Wallet\BFIMerchant\Http\Controllers\UserToBFIFundTransferController;

Route::group(['prefix' => 'admin/BFIMerchant', 'middleware' => ['web', 'auth']], function () {
    Route::get('view-bfi-merchant', [BFIMerchantController::class, 'index'])->name('bfi.view')->middleware('permission:View BFI Merchant');
    Route::get('create-bfi-merchant', [BFIMerchantController::class, 'create'])->name('bfi.create')->middleware('permission:Add BFI Merchant');
    Route::post('store-bfi-merchant', [BFIMerchantController::class, 'store'])->name('bfi.store')->middleware('permission:Add BFI Merchant');
    Route::post('delete-bfi-merchant/{id}', [BFIMerchantController::class, 'delete'])->name('bfi.delete')->middleware('permission:Delete BFI Merchant');

    Route::get('view-bfi-user', [BFIUserController::class, 'index'])->name('bfi.user.view')->middleware('permission:View BFI user');
    Route::get('create-bfi-ip/{id}', [BFIUserController::class, 'createIp'])->name('bfi.ip.create')->middleware('permission:Add ip');
    Route::post('create-bfi-ip/{id}', [BFIUserController::class, 'createIp'])->name('bfi.ip.create')->middleware('permission:Add ip');
    Route::post('store-bfi-ip', [BFIUserController::class, 'storeIp'])->name('bfi.ip.store')->middleware('permission:Add ip');

    Route::get('create-bfi-user', [BFIUserController::class, 'createBFIUser'])->name('bfi.user.create')->middleware('permission:Add BFI user');
    Route::post('create-bfi-user', [BFIUserController::class, 'storeBFIUser'])->name('bfi.user.store')->middleware('permission:Add BFI user');

    Route::get('change-bfi-user-status/{id}', [BFIUserController::class, 'editStatus'])->name('bfi.user.status.edit')->middleware('permission:Edit BFI user status');
    Route::post('change-bfi-user-status/{id}', [BFIUserController::class, 'updateStatus'])->name('bfi.user.status.update')->middleware('permission:Edit BFI user status');


    //BFI Execute Payment Routes
    Route::get('view-bfi-execute-payment', [BFIPaymentExecutePaymentController::class, 'index'])->name('view.bfi.execute.payment');

    //BFI To User Fund Transfer
    Route::get('view-bfi-to-user-fund-transfer', [BFIToUserFundTransferController::class, 'index'])->name('view.bfi.to.user.fund.transfer');
    Route::get('bfi-to-user-fund-transfer-check-payment/{id}',[BFIToUserFundTransferController::class,'checkPayment'])->name('view.bfi.to.user.check.payment');

    //User To BFI Fund Transfer
    Route::get('view-user-to-bfi-fund-transfer',[UserToBFIFundTransferController::class,'index'])->name('view.user.to.bfi.fund.transfer');
    Route::get('user-to-bfi-fund-transfer-check-payment/{id}',[UserToBFIFundTransferController::class,'checkPayment'])->name('user.to.bfi.fund.transfer.check.payment');

    //PDF view of BFI User
    Route::post('view-pdf-bfi-user/{id}',[BFIUserController::class,'createPDF'])->name('pdf.bfi.user.view');
});
