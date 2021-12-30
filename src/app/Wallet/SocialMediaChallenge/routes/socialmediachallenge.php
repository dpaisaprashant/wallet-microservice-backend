<?php

use App\Http\Controllers\ExcelExportController;
use App\Wallet\SocialMediaChallenge\Http\Controllers\SocialMediaChallengeUserController;
use App\Wallet\SocialMediaChallenge\Http\Controllers\SocialMediaChallengeWinnerController;
use Illuminate\Support\Facades\Route;
use App\Wallet\SocialMediaChallenge\Http\Controllers\SocialMediaChallengeController;
use App\Http\Controllers\PhpSpreadSheetController;


Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {

    //Social Media Challenge
    Route::get('social-challenge', [SocialMediaChallengeController::class, 'view'])->name('socialmediachallenge.view')->middleware('permission:View social media challenge');
    Route::get('social-challenge/create', [SocialMediaChallengeController::class, 'create'])->name('socialmediachallenge.create')->middleware('permission:Add social media challenge');
    Route::post('social-challenge/create', [SocialMediaChallengeController::class, 'store'])->name('socialmediachallenge.store')->middleware('permission:Add social media challenge');
    Route::get('social-challenge/edit/{id}', [SocialMediaChallengeController::class, 'edit'])->name('socialmediachallenge.edit')->middleware('permission:Edit social media challenge');
    Route::put('social-challenge/update/{id}', [SocialMediaChallengeController::class, 'update'])->name('socialmediachallenge.update')->middleware('permission:Edit social media challenge');
    Route::post('social-challenge/delete/{id}', [SocialMediaChallengeController::class, 'delete'])->name('socialmediachallenge.delete')->middleware('permission:Delete social media challenge');

    Route::get('social-challenge-user/{id}', [SocialMediaChallengeUserController::class, 'view'])->name('socialmediachallenge.user.view')->middleware('permission:View social media challenge');
    Route::get('social-challenge-user/edit/{id}', [SocialMediaChallengeUserController::class, 'edit'])->name('socialmediachallenge.user.edit')->middleware('permission:Edit social media challenge');
    Route::put('social-challenge-user/update/{id}', [SocialMediaChallengeUserController::class, 'update'])->name('socialmediachallenge.user.update')->middleware('permission:Edit social media challenge');
    Route::post('social-challenge-user/winner/{id}', [SocialMediaChallengeUserController::class, 'selectWinner'])->name('socialmediachallenge.user.winner')->middleware('permission:Edit social media challenge');

    Route::get('social-challenge/winners', [SocialMediaChallengeWinnerController::class, 'view'])->name('socialmediachallenge.winners')->middleware('permission:View social media challenge');
    Route::match(['get'],'social-challenge/random-winner/{id}', [SocialMediaChallengeUserController::class, 'selectWinnerRandom'])->name('socialmediachallenge.winner.random')->middleware('permission:Edit social media challenge');
    Route::match(['post'],'social-challenge/random-winner/{id}', [SocialMediaChallengeUserController::class, 'addToWinnersTable'])->name('socialmediachallenge.winner.random.add')->middleware('permission:Edit social media challenge');

//    socialmediachallenge.winner.random
});
