<?php

use Illuminate\Support\Facades\Route;
use App\Wallet\WalletIP\Http\Controllers\WalletIPController;


Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {

    //Blocked IP CRUD
    Route::get('blocked-ip', [WalletIPController::class, 'view'])->name('blockedip.view');
    Route::get('create-blocked-ip', [WalletIPController::class, 'create'])->name('blockedip.create');
    Route::post('create-blocked-ip', [WalletIPController::class, 'store'])->name('blockedip.store');
    Route::get('edit-blocked-ip/{id}', [WalletIPController::class, 'edit'])->name('blockedip.edit');
    Route::put('update-blocked-ip/{id}', [WalletIPController::class, 'update'])->name('blockedip.update');
    Route::post('delete-blockedip/{id}', [WalletIPController::class, 'delete'])->name('blockedip.delete');

});
