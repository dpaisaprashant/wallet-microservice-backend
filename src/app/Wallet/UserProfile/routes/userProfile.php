<?php

use App\Wallet\UserProfile\Http\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function () {

    Route::get('/users/new-profile/{id}', [UserProfileController::class,'userProfile'])->name('user.new_profile')->middleware('permission:User profile|View agent profile|Merchant profile');
    Route::get('/users/new-profile/kyc/{id}',[UserProfileController::class,'userKyc'])->name('user.new_profile.kyc');
    Route::get('/users/new/audit-trail/{wallet}/{id}',[UserProfileController::class,'userAuditTrail'])->name('user.new.audit_trail')->middleware('permission:View all audit trial|User profile');

});
