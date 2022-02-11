<?php

use App\Wallet\UserProfile\Http\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {

    Route::get('/users/new-profile/{id}', [UserProfileController::class,'userProfile'])->name('user.new_profile')->middleware('permission:User profile|View agent profile|Merchant profile');
    Route::get('/users/new-profile/kyc/{id}',[UserProfileController::class,'userKyc'])->name('user.new_profile.kyc');

});
