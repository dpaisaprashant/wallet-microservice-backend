<?php

use Illuminate\Support\Facades\Route;
use App\Wallet\BFIMerchant\Http\Controllers\BFIMerchantController;
use App\Wallet\BFIMerchant\Http\Controllers\BFIUserController;


Route::group(['prefix' => 'admin/BFIMerchant', 'middleware' => ['web','auth']], function () {
    Route::get('view-bfi-merchant',[BFIMerchantController::class,'index'])->name('bfi.view')->middleware('permission:View BFI Merchant');
    Route::get('create-bfi-merchant',[BFIMerchantController::class,'create'])->name('bfi.create')->middleware('permission:Add BFI Merchant');
    Route::post('store-bfi-merchant',[BFIMerchantController::class,'store'])->name('bfi.store')->middleware('permission:Add BFI Merchant');
    Route::post('delete-bfi-merchant/{id}',[BFIMerchantController::class,'delete'])->name('bfi.delete')->middleware('permission:Delete BFI Merchant');

    Route::get('view-bfi-user',[BFIUserController::class,'index'])->name('bfi.user.view')->middleware('permission:View BFI user');
    Route::get('create-bfi-ip/{id}',[BFIUserController::class,'createIp'])->name('bfi.ip.create')->middleware('permission:Add ip');
    Route::post('create-bfi-ip/{id}',[BFIUserController::class,'createIp'])->name('bfi.ip.create')->middleware('permission:Add ip');
    Route::post('store-bfi-ip',[BFIUserController::class,'storeIp'])->name('bfi.ip.store')->middleware('permission:Add ip');

    Route::get('create-bfi-user',[BFIUserController::class,'createBFIUser'])->name('bfi.user.create')->middleware('permission:Add BFI user');
    Route::post('create-bfi-user',[BFIUserController::class,'storeBFIUser'])->name('bfi.user.store')->middleware('permission:Add BFI user');

    Route::get('change-bfi-user-status/{id}',[BFIUserController::class,'editStatus'])->name('bfi.user.status.edit')->middleware('permission:Edit BFI user status');
    Route::post('change-bfi-user-status/{id}',[BFIUserController::class,'updateStatus'])->name('bfi.user.status.update')->middleware('permission:Edit BFI user status');
});
