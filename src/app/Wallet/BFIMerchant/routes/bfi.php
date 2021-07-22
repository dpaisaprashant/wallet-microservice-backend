<?php

use Illuminate\Support\Facades\Route;
use App\Wallet\BFIMerchant\Http\Controllers\BFIMerchantController;


Route::group(['prefix' => 'admin/BFIMerchant', 'middleware' => ['web','auth']], function () {
    Route::get('view-bfi-merchant',[BFIMerchantController::class,'index'])->name('bfi.view')->middleware('permission:View BFI Merchant');
    Route::get('create-bfi-merchant',[BFIMerchantController::class,'create'])->name('bfi.create')->middleware('permission:Add BFI Merchant');
    Route::post('store-bfi-merchant',[BFIMerchantController::class,'store'])->name('bfi.store')->middleware('permission:Add BFI Merchant');
    Route::post('delete-bfi-merchant/{id}',[BFIMerchantController::class,'delete'])->name('bfi.delete')->middleware('permission:Delete BFI Merchant');
});
