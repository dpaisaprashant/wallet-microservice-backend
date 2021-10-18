<?php

use Illuminate\Support\Facades\Route;
use App\Wallet\BonusToMainBalanceTransfer\Http\Controllers\BonusToMainBalanceTransferController;

Route::group(['prefix' => 'admin/BonusToMainBalanceTransfer', 'middleware' => ['web','auth']], function () {
    Route::post('/TransferBalance/{id}',[BonusToMainBalanceTransferController::class,'TransferBonusToMain'])->name('bonusToMainBalanceTransfer')->middleware('permission:Transfer bonus balance to main balance');
});
