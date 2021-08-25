<?php

use Illuminate\Support\Facades\Route;
use App\Wallet\NPSAccountLinkLoad\Http\Controllers\NPSAccountLinkLoadController;
use App\Http\Controllers\PhpSpreadSheetController;


Route::group(['prefix' => 'admin/transaction/', 'middleware' => ['web','auth']], function () {

    //View Load Wallet
    Route::get('nps-load-wallet', [NPSAccountLinkLoadController::class, 'view'])->name('npsaccountlinkload.view')->middleware('permission:View load wallet');
    //Excel Export
    Route::get('excel/nps-load-wallet', [PhpSpreadSheetController::class, 'NPSAccountLinkLoad'])->name('npsaccountlinkload.excel')->middleware('permission:Generate load wallet excel');;
    //View Report Page
    Route::get('nps-load-wallet/details/{id}', [NPSAccountLinkLoadController::class, 'viewDetails'])->name('npsaccountlinkload.detail')->middleware('permission:View load wallet');

});
