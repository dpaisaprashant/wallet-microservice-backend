<?php


use App\Http\Controllers\ExcelExportController;
use Illuminate\Support\Facades\Route;
use App\Wallet\Microservice\Http\Controllers\PreTransactionController;

Route::group(['prefix' => 'admin/microservice', 'middleware' => ['web','auth']], function () {
    Route::get('/PreTransactions',[PreTransactionController::class,'index'])->name('preTransaction.view')->middleware('permission:View pre-transactions');
    Route::get('/excel/preTransactions',[ExcelExportController::class,'preTransaction'])->name('preTransaction.excel');
});
