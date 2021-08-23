<?php

use Illuminate\Support\Facades\Route;
use App\Wallet\WalletIP\Http\Controllers\WalletAPIController;


Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {

    //Blocked IP CRUD
    Route::get('blocked-ip', [WalletAPIController::class, 'view'])->name('blockedip.view')->middleware('permission:View blocked ip');
    Route::get('create-blocked-ip', [WalletAPIController::class, 'create'])->name('blockedip.create')->middleware('permission:Add blocked ip');
    Route::post('create-blocked-ip', [WalletAPIController::class, 'store'])->name('blockedip.store')->middleware('permission:Add blocked ip');
    Route::get('edit-blocked-ip/{id}', [WalletAPIController::class, 'edit'])->name('blockedip.edit')->middleware('permission:Edit blocked ip');
    Route::put('update-blocked-ip/{id}', [WalletAPIController::class, 'update'])->name('blockedip.update')->middleware('permission:Edit blocked ip');
    Route::post('delete-blockedip/{id}', [WalletAPIController::class, 'delete'])->name('blockedip.delete')->middleware('permission:Delete blocked ip');

    //Whitelist IP CRUD
    Route::get('whitelist-ip', [WalletAPIController::class, 'view_whitelist'])->name('whitelistedIP.view')->middleware('permission:View whitelisted ip');
    Route::get('whitelist-ip/create', [WalletAPIController::class, 'create_whitelist'])->name('whitelistedIP.create')->middleware('permission:Add whitelisted ip');
    Route::post('whitelist-ip/create', [WalletAPIController::class, 'store_whitelist'])->name('whitelistedIP.store')->middleware('permission:Add whitelisted ip');
    Route::get('whitelist-ip/edit/{id}', [WalletAPIController::class, 'edit_whitelist'])->name('whitelistedIP.edit')->middleware('permission:Edit whitelisted ip');
    Route::put('whitelist-ip/update/{id}', [WalletAPIController::class, 'update_whitelist'])->name('whitelistedIP.update')->middleware('permission:Edit whitelisted ip');
    Route::post('whitelist/delete/{id}', [WalletAPIController::class, 'delete_whitelist'])->name('whitelistedIP.delete')->middleware('permission:Delete whitelisted ip');

});
