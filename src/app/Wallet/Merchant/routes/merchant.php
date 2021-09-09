<?php

use App\Wallet\Merchant\Http\Controllers\MerchantEventController;
use App\Wallet\Merchant\Http\Controllers\MerchantProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/merchant', 'middleware' => ['web','auth']], function () {

    Route::get('event-list', [MerchantEventController::class, 'eventLists'])->name('merchant.event.list')->middleware('permission:Merchant event list');
    Route::get('pending-event-list', [MerchantEventController::class, 'pendingEventList'])->name('merchant.event.pendingList')->middleware('permission:Merchant pending event list');
    Route::match(['get', 'post'],'event-detail/{id}', [MerchantEventController::class, 'updateEvent'])->name('merchant.event.detail');

    //Merchant Products
    Route::get('merchant-product', [MerchantProductController::class, 'listProduct'])->name('merchant.product.list');
    Route::get('merchant-product/add', [MerchantProductController::class, 'addProduct'])->name('merchant.product.add');
    Route::post('merchant-product/create', [MerchantProductController::class, 'createProduct'])->name('merchant.product.create');
    Route::get('merchant-product/edit/{id}', [MerchantProductController::class, 'editProduct'])->name('merchant.product.edit');
    Route::put('merchant-product/update/{id}', [MerchantProductController::class, 'updateProduct'])->name('merchant.product.update');
    Route::post('merchant-product/delete/{id}', [MerchantProductController::class, 'deleteProduct'])->name('merchant.product.delete');

});
