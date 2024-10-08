<?php

use App\Http\Controllers\ExcelExportController;
use App\Wallet\Referral\Http\Controllers\ReferralController;
use App\Wallet\Referral\Http\Controllers\ReferralSchemaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/referral', 'middleware' => ['web','auth']], function () {

    //report
    Route::match(['get', 'post'],'referral-report', [ReferralController::class, 'referralReport'])->name('referral.report')->middleware('permission:Report referral');
    Route::match(['get', 'post'],'register-using-referral-user-report', [ReferralController::class, 'registerUsingReferralUserReport'])->name('referral.registerUsingReferralUserReport')->middleware('permission:Report register using referral user');

    //Referral schema
    Route::get('referral-schema', [ReferralSchemaController::class, 'index'])->name('referral.schema.index');
    Route::match(['get', 'post'],'referral-schema/create', [ReferralSchemaController::class, 'create'])->name('referral.schema.create');
    Route::match(['get', 'post'],'referral-schema/update/{referralSchema}', [ReferralSchemaController::class, 'update'])->name('referral.schema.update');

    // Excel

    Route::get('/register-using-referral-user-report/excel',[ExcelExportController::class, 'registerUsingReferral'])->name('register-using-referral.excel');
});
