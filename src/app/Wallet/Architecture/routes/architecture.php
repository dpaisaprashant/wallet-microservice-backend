<?php

use App\Http\Controllers\ExcelExportController;
use App\Wallet\Architecture\Http\Controllers\WalletTransactionCashbackController;
use App\Wallet\Architecture\Http\Controllers\WalletTransactionCommissionController;
use App\Wallet\Architecture\Http\Controllers\WalletTransactionTypeController;
use App\Wallet\Architecture\Http\Controllers\WalletTransactionTypeMerchantRevenueController;
use App\Wallet\Architecture\Http\Controllers\WalletUserCashbackController;
use App\Wallet\Architecture\Http\Controllers\WalletUserCommissionController;
use App\Wallet\Architecture\Http\Controllers\WalletServiceController;
use App\Wallet\Referral\Http\Controllers\ReferralController;
use App\Wallet\Referral\Http\Controllers\ReferralSchemaController;
use App\Wallet\Architecture\Http\Controllers\WalletTypeTransactionController;
use Illuminate\Support\Facades\Route;
use App\Wallet\Architecture\Http\Controllers\WalletPermissionTransactionTypeController;
use App\Wallet\Architecture\Http\Controllers\AgentTypeHierarchyCashbackController;
use App\Wallet\Architecture\Http\Controllers\WalletBonusController;

Route::group(['prefix' => 'admin/architecture', 'middleware' => ['web','auth']], function () {
    Route::get('/vendor-transactions/{vendorName}', [WalletTransactionTypeController::class, 'vendorTransactions'])->name('architecture.vendor.transaction')->middleware('permission:Architecture vendor transaction');

    // Export to Excel
//            Route::get('/excel/complete-transaction', 'ExcelExportController@completeTransactions')->name('transaction.complete.excel');
    Route::get('/excel/walletTransactionType/{vendorName}',[ExcelExportController::class,'walletTransactionTypes'])->name('architecture.excel.vendor.transaction');
    Route::get('/excel/agentTypeHierarchyCashback',[ExcelExportController::class,'agentTypeHierarchyCashback'])->name('architecture.agentTypeHierarchyCashback.excel');

    //GET USER TYPE LISTS
    Route::post('/get-user-type-lists', [WalletTransactionTypeController::class, 'getUserTransactionTypeList'])->name('architecture.userType.list');
    Route::post('/get-user-lists', [WalletTransactionTypeController::class, 'getUserList'])->name('architecture.user.list');

    //TRANSACTION CASHBACK
    //Create transaction cashback
    Route::get('/wallet-transaction-cashbacks/{walletTransaction}', [WalletTransactionCashbackController::class, 'index'])->name('architecture.transaction.cashback');
    Route::match(['get', 'post'], '/wallet-transaction-cashbacks/{walletTransaction}/create', [WalletTransactionCashbackController::class, 'create'])->name('architecture.transaction.cashback.create');
    Route::match(['get', 'post'], '/wallet-transaction-cashbacks/edit/{id}', [WalletTransactionCashbackController::class, 'update'])->name('architecture.transaction.cashback.update');
    Route::post('/wallet-transaction-cashbacks/delete', [WalletTransactionCashbackController::class, 'delete'])->name('architecture.transaction.cashback.delete');

    //Create single user cashback
    Route::get('/user-wallet-transaction-cashbacks/{walletTransaction}', [WalletUserCashbackController::class, 'index'])->name('architecture.user.cashback');
    Route::match(['get', 'post'], '/user-wallet-transaction-cashbacks/{walletTransaction}/create', [WalletUserCashbackController::class, 'create'])->name('architecture.user.cashback.create');
    Route::match(['get', 'post'], '/user-wallet-transaction-cashbacks/edit/{id}', [WalletUserCashbackController::class, 'update'])->name('architecture.user.cashback.update');
    Route::post('/user-wallet-transaction-cashbacks/delete', [WalletUserCashbackController::class, 'delete'])->name('architecture.user.cashback.delete');



    //Create transaction commission
    Route::get('/wallet-transaction-commissions/{walletTransaction}', [WalletTransactionCommissionController::class, 'index'])->name('architecture.transaction.commission');
    Route::match(['get', 'post'], '/wallet-transaction-commissions/{walletTransaction}/create', [WalletTransactionCommissionController::class, 'create'])->name('architecture.transaction.commission.create');
    Route::match(['get', 'post'], '/wallet-transaction-commissions/edit/{id}', [WalletTransactionCommissionController::class, 'update'])->name('architecture.transaction.commission.update');
    Route::post('/wallet-transaction-commissions/delete', [WalletTransactionCommissionController::class, 'delete'])->name('architecture.transaction.commission.delete');


    //Create single user commission
    Route::get('/user-wallet-transaction-commission/{walletTransaction}', [WalletUserCommissionController::class, 'index'])->name('architecture.user.commission');
    Route::match(['get', 'post'], '/user-wallet-transaction-commission/{walletTransaction}/create', [WalletUserCommissionController::class, 'create'])->name('architecture.user.commission.create');
    Route::match(['get', 'post'], '/user-wallet-transaction-commission/edit/{id}', [WalletUserCommissionController::class, 'update'])->name('architecture.user.commission.update');
    Route::post('/user-wallet-transaction-commission/delete', [WalletUserCommissionController::class, 'delete'])->name('architecture.user.commission.delete');

    //Wallet permission transaction type
    Route::get('/view-wallet-permission-transaction-type',[WalletPermissionTransactionTypeController::class, 'index'])->name('wallet.permission.transaction.type.view')->middleware('permission:View wallet permission transaction type');
    Route::get('/create-wallet-permission-transaction-type',[WalletPermissionTransactionTypeController::class,'create'])->name('wallet.permission.transaction.type.create');
    Route::post('/store-wallet-permission-transaction-type',[WalletPermissionTransactionTypeController::class, 'store'])->name('wallet.permission.transaction.type.store');
    Route::post('/delete-wallet-permission-transaction-type/{id}',[WalletPermissionTransactionTypeController::class,'delete'])->name('wallet.permission.transaction.type.delete');

    // Wallet Transaction Type Merchant Revenue
    Route::get('/wallet-merchant-revenue/{walletTransaction}', [WalletTransactionTypeMerchantRevenueController::class, 'index'])->name('architecture.wallet.merchantRevenue');
    Route::match(['get', 'post'], '/wallet-merchant-revenue/{walletTransaction}/create', [WalletTransactionTypeMerchantRevenueController::class, 'create'])->name('architecture.wallet.merchantRevenue.create');
    Route::post('/wallet-merchant-revenue/delete', [WalletTransactionTypeMerchantRevenueController::class, 'delete'])->name('architecture.wallet.merchantRevenue.delete');


    //Wallet transaction types
    Route::get('/wallet-transaction-type',[WalletTypeTransactionController::class,'index'])->name('wallet.transaction.type.view');//Viewing wallet transaction type
    Route::get('/add-wallet-transaction-type',[WalletTypeTransactionController::class,'create'])->name('wallet.transaction.type.create');//Form for creating wallet transaction type
    Route::post('/add-wallet-transaction-type',[WalletTypeTransactionController::class,'store'])->name('wallet.transaction.type.store');//Storing wallet transaction type
    Route::get('/edit-wallet-transaction-type/{id}',[WalletTypeTransactionController::class,'edit'])->name('wallet.transaction.type.edit');//Edit wallet transaction type
    Route::post('/edit-wallet-transaction-type/{id}',[WalletTypeTransactionController::class,'update'])->name('wallet.transaction.type.update');//Updating wallet transaction type
    Route::post('/delete-wallet-transaction-type/{id}',[WalletTypeTransactionController::class,'delete'])->name('wallet.transaction.type.delete');//Delete wallet transaction type




    //Agent Tyoe Hierarchy Cashback
    Route::get('/view-agent-type-hierarchy-cashback',[AgentTypeHierarchyCashbackController::class,'index'])->name('view.agent.type.hierarchy.cashback');
    Route::post('/update-agent-type-hierarchy-cashback',[AgentTypeHierarchyCashbackController::class,'update'])->name('update.agent.type.hierarchy.cashback');


    //Wallet Services


    Route::get('/view-wallet-service',[WalletServiceController::class,'index'])->name('wallet.service.view')->middleware('permission:View wallet service');//View wallet service
    Route::get('/add-wallet-service',[WalletServiceController::class,'create'])->name('wallet.service.create')->middleware('permission:Add wallet service');//Form for creating wallet service
    Route::post('/add-wallet-service',[WalletServiceController::class,'store'])->name('wallet.service.store')->middleware('permission:Add wallet service');//Storing wallet service
    Route::get('/edit-wallet-service/{id}',[WalletServiceController::class,'edit'])->name('wallet.service.edit')->middleware('permission:Edit wallet service');//edit wallet service
    Route::post('/edit-wallet-service/{id}',[WalletServiceController::class,'update'])->name('wallet.service.update')->middleware('permission:Edit wallet service');//update wallet service
    Route::post('/delete-wallet-service/{id}',[WalletServiceController::class,'delete'])->name('wallet.service.delete')->middleware('permission:Delete wallet service');//delete wallet service


    //Agent Type Hierarchy Cashback
    Route::get('/view-agent-type-hierarchy-cashback',[AgentTypeHierarchyCashbackController::class,'index'])->name('view.agent.type.hierarchy.cashback');
    Route::post('/update-agent-type-hierarchy-cashback',[AgentTypeHierarchyCashbackController::class,'update'])->name('update.agent.type.hierarchy.cashback');

    //Bonus
    Route::get('/wallet-bonus-transaction/{walletTransaction}',[WalletBonusController::class,'index'])->name('walletBonus.index');
    Route::get('/wallet-bonus-transaction/{walletTransaction}/create',[WalletBonusController::class,'create'])->name('walletBonus.create');
    Route::post('/wallet-bonus-transaction/{walletTransaction}/store',[WalletBonusController::class,'store'])->name('walletBonus.store');
    Route::post('/wallet-bonus-transaction/{walletTransaction}/delete',[WalletBonusController::class,'delete'])->name('walletBonus.delete');
});
