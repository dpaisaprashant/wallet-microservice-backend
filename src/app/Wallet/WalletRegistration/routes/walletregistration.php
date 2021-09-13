<?php

use Illuminate\Support\Facades\Route;
use App\Wallet\WalletRegistration\Http\Controllers\MerchantRegistrationController;


Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {

    //Create Merchant
    Route::get('merchant/create', [MerchantRegistrationController::class, 'view'])->name('create.merchant.view');
    Route::post('merchant/create', [MerchantRegistrationController::class, 'create'])->name('create.merchant.store');


//    Route::match(['get', 'post'],'/backend-user/create', 'BackendUsersController@create')->name('backendUser.create')->middleware('permission:Backend user create');




//    Route::get('create-blocked-ip', [WalletIPController::class, 'create'])->name('blockedip.create')->middleware('permission:Add blocked ip');
//    Route::post('create-blocked-ip', [WalletIPController::class, 'store'])->name('blockedip.store')->middleware('permission:Add blocked ip');
//    Route::get('edit-blocked-ip/{id}', [WalletIPController::class, 'edit'])->name('blockedip.edit')->middleware('permission:Edit blocked ip');
//    Route::put('update-blocked-ip/{id}', [WalletIPController::class, 'update'])->name('blockedip.update')->middleware('permission:Edit blocked ip');
//    Route::post('delete-blockedip/{id}', [WalletIPController::class, 'delete'])->name('blockedip.delete')->middleware('permission:Delete blocked ip');

});
