<?php

use App\Wallet\Referral\Http\Controllers\ReferralController;
use App\Wallet\Referral\Http\Controllers\ReferralSchemaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/referral', 'middleware' => ['web','auth']], function () {

    Route::match(['get', 'post'],'referral-report', [ReferralController::class, 'referralReport'])->name('referral.report');

    //Referral schema
    Route::get('referral-schema', [ReferralSchemaController::class, 'index'])->name('referral.schema.index');
    Route::match(['get', 'post'],'referral-schema/create', [ReferralSchemaController::class, 'create'])->name('referral.schema.create');
    Route::match(['get', 'post'],'referral-schema/update/{referralSchema}', [ReferralSchemaController::class, 'update'])->name('referral.schema.update');
});
