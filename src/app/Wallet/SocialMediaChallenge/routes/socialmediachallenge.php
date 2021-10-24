<?php

use App\Http\Controllers\ExcelExportController;
use Illuminate\Support\Facades\Route;
use App\Wallet\SocialMediaChallenge\Http\Controllers\SocialMediaChallengeController;
use App\Http\Controllers\PhpSpreadSheetController;


Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {

    //View Social Media Challenge
    Route::get('social-challenge', [SocialMediaChallengeController::class, 'view'])->name('linkedaccounts.view')->middleware('permission:View nps linked account');
});
