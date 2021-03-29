<?php

use App\Wallet\Merchant\Http\Controllers\MerchantEventController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/merchant', 'middleware' => ['web','auth']], function () {

    Route::get('event-list', [MerchantEventController::class, 'eventLists'])->name('merchant.event.list');
    Route::get('pending-event-list', [MerchantEventController::class, 'pendingEventList'])->name('merchant.event.pendingList');
    Route::match(['get', 'post'],'event-detail/{id}', [MerchantEventController::class, 'updateEvent'])->name('merchant.event.detail');
});
