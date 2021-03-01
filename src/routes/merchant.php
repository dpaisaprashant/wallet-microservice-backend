<?php

use App\Http\Controllers\Setting\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/merchants', 'MerchantController@view')->name('merchant.view');

    Route::get('/merchants/profile/{id}', 'MerchantController@profile')->name('merchant.profile');
    Route::get('/merchants/kyc/{id}', 'MerchantController@kyc')->name('merchant.kyc');
    Route::get('/merchants/transactions/{id}', 'MerchantController@transaction')->name('merchant.transaction');

    Route::post('/merchants/change-kyc-status', 'MerchantController@changeKYCStatus')->name('merchant.changeKYCStatus'); // Change KYC status

    Route::post('send-merchant-notification/{merchant}', "MerchantController@merchantNotification")->name('notification.merchant');

    Route::post('change-merchant-commission/{merchant}', "MerchantController@merchantCommission")->name('merchant.commission');
    Route::post('change-merchant-min-bank-transfer-amount/{merchant}', "MerchantController@merchantMinBankTransferBalance")->name('merchant.minBankTransferBalance');
    Route::post('change-merchant-bank-account/{merchant}', "MerchantController@merchantBankAccount")->name('merchant.bankAccount');

    //Locked Merchants
    Route::get('/merchant/locked', 'LockedMerchantController@index')->name('merchant.locked.list');
    Route::get('/merchant/login-attempts/{id}', 'LockedMerchantController@loginAttempts')->name('merchant.login.attempts');
    Route::post('/merchant/update-login-attempt', 'LockedMerchantController@updateLoginAttempts')->name('merchant.loginAttemptsUpdate');

    Route::match(['get', 'post'], '/settings/merchant', [SettingController::class, 'merchantSetting'])->name('settings.merchant');
});
