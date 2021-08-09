<?php
use Illuminate\Support\Facades\Route;
use App\Wallet\CellPayUserTransaction\Http\Controllers\CellPayUserTransactionController;

Route::group(['prefix' => 'admin/cellPay-Transactions', 'middleware' => ['web','auth']], function () {
    Route::get('cellPay-transactions-list',[CellPayUserTransactionController::class,'index'])->name('cellPayUserTransaction.view')->middleware('permission:Cellpay user transaction view');
});
