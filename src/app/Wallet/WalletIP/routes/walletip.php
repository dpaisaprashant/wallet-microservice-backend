<?php

use Illuminate\Support\Facades\Route;
use App\Wallet\WalletIP\Http\Controllers\WalletIPController;


Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {

    //Blocked IP CRUD
    Route::get('blocked-ip', [WalletIPController::class, 'view'])->name('blockedip.view')->middleware('permission:View blocked ip');
    Route::get('create-blocked-ip', [WalletIPController::class, 'create'])->name('blockedip.create')->middleware('permission:Add blocked ip');
    Route::post('create-blocked-ip', [WalletIPController::class, 'store'])->name('blockedip.store')->middleware('permission:Add blocked ip');
    Route::get('edit-blocked-ip/{id}', [WalletIPController::class, 'edit'])->name('blockedip.edit')->middleware('permission:Edit blocked ip');
    Route::put('update-blocked-ip/{id}', [WalletIPController::class, 'update'])->name('blockedip.update')->middleware('permission:Edit blocked ip');
    Route::post('delete-blockedip/{id}', [WalletIPController::class, 'delete'])->name('blockedip.delete')->middleware('permission:Delete blocked ip');

    //Whitelist IP CRUD
    Route::get('whitelist-ip', [WalletIPController::class, 'view_whitelist'])->name('whitelistedIP.view')->middleware('permission:View whitelisted ip');
    Route::get('whitelist-ip/create', [WalletIPController::class, 'create_whitelist'])->name('whitelistedIP.create')->middleware('permission:Add whitelisted ip');
    Route::post('whitelist-ip/create', [WalletIPController::class, 'store_whitelist'])->name('whitelistedIP.store')->middleware('permission:Add whitelisted ip');
    Route::get('whitelist-ip/edit/{id}', [WalletIPController::class, 'edit_whitelist'])->name('whitelistedIP.edit')->middleware('permission:Edit whitelisted ip');
    Route::put('whitelist-ip/update/{id}', [WalletIPController::class, 'update_whitelist'])->name('whitelistedIP.update')->middleware('permission:Edit whitelisted ip');
    Route::post('whitelist/delete/{id}', [WalletIPController::class, 'delete_whitelist'])->name('whitelistedIP.delete')->middleware('permission:Delete whitelisted ip');

});
