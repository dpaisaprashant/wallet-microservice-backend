<?php

use Illuminate\Support\Facades\Route;
use App\Wallet\LinkedAccounts\Http\Controllers\LinkedAccountsController;
use App\Http\Controllers\PhpSpreadSheetController;


Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {

    //View Linked Accounts
    Route::get('linked-accounts', [LinkedAccountsController::class, 'view'])->name('linkedaccounts.view')->middleware('permission:View nps linked account');
   //Excel Export
//    Route::get('/excel/nps-account-link-load', [PhpSpreadSheetController::class, 'NPSAccountLinkLoad'])->name('npsaccountlinkload.excel')->middleware('permission:Generate nps linked account excel');
});
