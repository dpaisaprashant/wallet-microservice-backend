<?php

use App\Http\Controllers\ExcelExportController;
use Illuminate\Support\Facades\Route;
use App\Wallet\LinkedAccounts\Http\Controllers\LinkedAccountsController;
use App\Http\Controllers\PhpSpreadSheetController;


Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {

    //View Linked Accounts
    Route::get('linked-accounts', [LinkedAccountsController::class, 'view'])->name('linkedaccounts.view')->middleware('permission:View nps linked account');
   //Excel Export
    Route::get('/excel/linked-accounts', [ExcelExportController::class, 'linkedAccount'])->name('linkedAccount.excel')->middleware('permission:View nps linked account');
});
