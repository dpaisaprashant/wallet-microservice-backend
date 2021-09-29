<?php

use App\Wallet\Merchant\Http\Controllers\MerchantAddressController;
use App\Wallet\Merchant\Http\Controllers\MerchantEventController;
use App\Wallet\Merchant\Http\Controllers\MerchantProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/merchant', 'middleware' => ['web','auth']], function () {

    Route::get('event-list', [MerchantEventController::class, 'eventLists'])->name('merchant.event.list')->middleware('permission:Merchant event list');
    Route::get('pending-event-list', [MerchantEventController::class, 'pendingEventList'])->name('merchant.event.pendingList')->middleware('permission:Merchant pending event list');
    Route::match(['get', 'post'],'event-detail/{id}', [MerchantEventController::class, 'updateEvent'])->name('merchant.event.detail');

    //Merchant Products
    Route::get('merchant-product', [MerchantProductController::class, 'listProduct'])->name('merchant.product.list')->middleware('permission:View merchant product');
    Route::get('merchant-product/add', [MerchantProductController::class, 'addProduct'])->name('merchant.product.add')->middleware('permission:Add merchant product');
    Route::post('merchant-product/create', [MerchantProductController::class, 'createProduct'])->name('merchant.product.create')->middleware('permission:Add merchant product');
    Route::get('merchant-product/edit/{id}', [MerchantProductController::class, 'editProduct'])->name('merchant.product.edit')->middleware('permission:Edit merchant product');
    Route::put('merchant-product/update/{id}', [MerchantProductController::class, 'updateProduct'])->name('merchant.product.update')->middleware('permission:Edit merchant product');
    Route::post('merchant-product/delete/{id}', [MerchantProductController::class, 'deleteProduct'])->name('merchant.product.delete')->middleware('permission:Delete merchant product');

    //Merchant Address
    Route::get('merchant-address', [MerchantAddressController::class, 'listAddress'])->name('merchant.address.list')->middleware('permission:View merchant address');
    Route::get('merchant-address/add', [MerchantAddressController::class, 'addAddress'])->name('merchant.address.add')->middleware('permission:Add merchant address');
    Route::post('merchant-address/create', [MerchantAddressController::class, 'createAddress'])->name('merchant.address.create')->middleware('permission:Add merchant address');
    Route::get('merchant-address/edit/{id}', [MerchantAddressController::class, 'editAddress'])->name('merchant.address.edit')->middleware('permission:Edit merchant address');
    Route::put('merchant-address/update/{id}', [MerchantAddressController::class, 'updateAddress'])->name('merchant.address.update')->middleware('permission:Edit merchant address');
    Route::post('merchant-address/delete/{id}', [MerchantAddressController::class, 'deleteAddress'])->name('merchant.address.delete')->middleware('permission:Delete merchant address');

});
