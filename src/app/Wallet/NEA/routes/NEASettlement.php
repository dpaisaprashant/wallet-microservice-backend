<?php
use Illuminate\Support\Facades\Route;
use App\Wallet\NEA\Http\Controllers\NEAController;

Route::group(['prefix' => 'admin/NEA', 'middleware' => ['web','auth']], function () {
    Route::get('View-NEA-Settlement',[NEAController::class,'ViewNEASettlement'])->name('ViewNEASettlement');
    Route::post('NEA-Settle',[NEAController::class,'SettleNea'])->name('SettleNea');
});
