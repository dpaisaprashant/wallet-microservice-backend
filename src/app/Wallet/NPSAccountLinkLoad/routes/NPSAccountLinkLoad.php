<?php

use Illuminate\Support\Facades\Route;
use App\Wallet\NPSAccountLinkLoad\Http\Controllers\NPSAccountLinkLoadController;
use App\Http\Controllers\PhpSpreadSheetController;


Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {

    //View Load Wallet
    Route::get('nps-account-link-load', [NPSAccountLinkLoadController::class, 'view'])->name('npsaccountlinkload.view');
   //Excel Export
   Route::get('/excel/nps-account-link-load', [PhpSpreadSheetController::class, 'NPSAccountLinkLoad'])->name('npsaccountlinkload.excel');
});
