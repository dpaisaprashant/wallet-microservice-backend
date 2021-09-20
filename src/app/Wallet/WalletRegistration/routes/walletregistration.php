<?php

use Illuminate\Support\Facades\Route;
use App\Wallet\WalletRegistration\Http\Controllers\MerchantRegistrationController;


Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {

    //Create Merchant
    Route::get('merchant/create', [MerchantRegistrationController::class, 'view'])->name('create.merchant.view')->middleware('permission:Create merchant');
    Route::post('merchant/create', [MerchantRegistrationController::class, 'create'])->name('create.merchant.store')->middleware('permission:Create merchant');


//    Route::match(['get', 'post'],'/backend-user/create', 'BackendUsersController@create')->name('backendUser.create')->middleware('permission:Backend user create');

});
