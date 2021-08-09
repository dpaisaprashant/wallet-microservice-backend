<?php
use Illuminate\Support\Facades\Route;
use App\Wallet\NicAsia\Http\Controllers\NICAsiaCyberSourceLoadTransactionController;

Route::group(['prefix' => 'admin/cellPay-Transactions', 'middleware' => ['web','auth']], function () {
    //NicAsia CyberSource
    Route::get('transaction/nicasia-cybesource-load-transaction',[NICAsiaCyberSourceLoadTransactionController::class,'index'])->name('nicAsia.viewCyberSourceLoad')->middleware('permission:Nicasia cybersource view');
//    Route::get('transaction/nicasia-cybesource-load-transaction/detail/{id}', 'TransactionController@nicAsiaCyberSourceLoadDetail')->name('nicasia.cyberSourceLoadTransaction.detail');
});
