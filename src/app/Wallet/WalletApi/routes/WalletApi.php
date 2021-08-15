<?php
use Illuminate\Support\Facades\Route;
use App\Wallet\WalletApi\Http\Controllers\WalletApiController;


Route::group(['prefix' => 'admin/walletApi', 'middleware' => ['web','auth']], function () {
    Route::post('/API-Response/{id}',[WalletApiController::class,'NCHLAPIResponse'])->name('wallet.api.nchl.response');
});
