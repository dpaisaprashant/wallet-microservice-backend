<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Admin;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/', 'AdminController@login')->middleware('guest'); //admin login
Route::group(['prefix' => 'admin'], function () {

    /**
     *Admin Login
     */
    Route::match(['get', 'post'], '/login', 'AdminController@login')->name('admin.login')->middleware('guest'); //admin login
    Route::match(['get', 'post'], '/login/otp', 'AdminController@loginOTP')->name('admin.login.otp')->middleware('guest');

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/logout', 'AdminController@logout')->name('admin.logout'); //admin logout

        Route::get('/dashboard-npay', 'DashboardController@npay')->name('admin.dashboard.npay')->middleware('permission:Stat Dashboard npay');
        Route::get('/dashboard-paypoint', 'DashboardController@paypoint')->name('admin.dashboard.paypoint')->middleware('permission:Stat Dashboard paypoint');
        Route::get('/dashboard-kyc', 'DashboardController@kyc')->name('admin.dashboard.kyc')->middleware('permission:Stat Dashboard KYC');
        Route::get('/dashboard-nchl-bank-transfer', 'DashboardController@nchlBankTransfer')->name('admin.dashboard.nchl.bankTransfer');
        Route::get('/dashboard-nchl-load-transaction', 'DashboardController@nchlLoadTransaction')->name('admin.dashboard.nchl.loadTransaction');

        Route::get('/dashboard', "AdminController@index")->name('admin.dashboard'); //admin dashboard
        Route::post('/dashboard/yearly-graph-paypoint', "AdminController@payPointYearly")->name('admin.dashboard.paypoint.yearly'); //admin yearly graph
        Route::post('/dashboard/yearly-graph-npay', "AdminController@nPayYearly")->name('admin.dashboard.npay.yearly'); //admin yearly graphStat Dashboard KYC

        /**
         * Backend users
         */
        Route::get('/backend-user', 'BackendUsersController@view')->name('backendUser.view')->middleware('permission:Backend users view');
        Route::match(['get', 'post'],'/backend-user/create', 'BackendUsersController@create')->name('backendUser.create')->middleware('permission:Backend user create');
        Route::match(['get', 'post'], '/permission/{user_id}', 'BackendUsersController@permission')->name('backendUser.permission')->middleware('permission:Backend user update permission');
        Route::match(['get', 'post'], '/role/{user_id}', 'BackendUsersController@role')->name('backendUser.role')->middleware('permission:Backend user update role');

        Route::match(['get', 'post'], '/backend-user/profile', 'BackendUsersController@profile')->name('backendUser.profile')->middleware('permission:Backend user update profile');
        Route::match(['get', 'post'], '/backend-user/change-password', 'BackendUsersController@changePassword')->name('backendUser.changePassword')->middleware('permission:Backend user change password');
        Route::post('/backend-user/reset-password', 'BackendUsersController@resetPassword')->name('backendUser.resetPassword')->middleware('permission:Backend user reset password');

        Route::get('backend-user-changed-kyc', 'BackendUsersController@kycList')->name('backendUser.kycList')->middleware('permission:KYC list changed by backend user view');


        Route::get('/roles', 'RoleController@view')->name('role.view')->middleware('permission:Roles view');
        Route::match(['get', 'post'],'/roles/create', 'RoleController@create')->name('role.create')->middleware('permission:Role create');
        Route::match(['get', 'post'], '/role/edit/{role_id}', 'RoleController@edit')->name('role.edit')->middleware('permission:Role edit');

        /**
         * Backend log
         */
        Route::get('/backend-log/all', 'BackendLogController@all')->name('backendLog.all')->middleware('permission:Backend user log view');
        /**
         * API log
         */
        Route::get('/api-log', 'APILogController@all')->name('apiLog.all');

        /**
         * Settings
         */
        Route::match(['get', 'post'], '/settings/general', 'Setting\SettingController@generalSetting')->name('settings.general')->middleware('permission:General setting view|General setting update');

        Route::match(['get', 'post'], '/settings/npay', 'Setting\SettingController@npaySetting')->name('settings.npay')->middleware('permission:Npay setting view|Npay setting update'); //NPay Setting
        Route::match(['get', 'post'], '/settings/nps', 'Setting\SettingController@npsSetting')->name('settings.nps'); //NPS Setting

        Route::match(['get', 'post'], '/settings/paypoint/commission', 'Setting\SettingController@paypointCommissionSetting')->name('settings.paypoint.commission');
        Route::match(['get', 'post'], '/settings/paypoint', 'Setting\SettingController@paypointSetting')->name('settings.paypoint')->middleware('permission:Paypoint setting view|Paypoint setting update');

        Route::match(['get', 'post'], '/settings/limits', 'Setting\SettingController@limitSetting')->name('settings.limit')->middleware('permission:Limits setting view|Limits setting update'); //Limit Setting
        Route::match(['get', 'post'], '/settings/cashback', 'Setting\SettingController@cashBackSetting')->name('settings.cashback')->middleware('permission:Paypoint cashback setting view');
        Route::match(['get', 'post'], '/settings/transaction-fee', 'Setting\SettingController@transactionFeeSetting')->name('settings.transactionFee')->middleware('permission:Transaction fee setting view');
        Route::match(['get', 'post'], '/settings/kyc', 'Setting\SettingController@KYCSetting')->name('settings.kyc')->middleware('permission:KYC setting view');
        Route::match(['get', 'post'], '/settings/otp', 'Setting\SettingController@OTPSetting')->name('settings.otp')->middleware('permission:OTP setting view');

        Route::match(['get', 'post'], 'settings/nchl-load-transaction', 'Setting\SettingController@nchlLoadSetting')->name('settings.nchl.load');
        Route::match(['get', 'post'], 'settings/nchl-bank-transfer', 'Setting\SettingController@nchlBankTransferSetting')->name('settings.nchl.bankTransfer');
        Route::match(['get', 'post'], 'settings/nchl-aggregated-payments', 'Setting\SettingController@nchlAggregatedPaymentSetting')->name('settings.nchl.aggregatedPayments');

        Route::match(['get', 'post'], 'settings/nchl-aggregated-payment/app-ids/list', 'Setting\NchlAggregatedPaymentIdSettingController@index')->name('settings.nchl.aggregatedService.list');

        Route::match(['get', 'post'], 'settings/nicasia-cybersource', 'Setting\SettingController@nicAsiaCyberSource')->name('settings.nicAsiaCyberSource');

        Route::match(['get', 'post'], 'settings/referral', 'Setting\SettingController@referral')->name('settings.referral');

        //bonus
        Route::match(['get', 'post'], '/settings/bonus', 'Setting\SettingController@bonusSetting')->name('settings.bonus');

        //notification
        Route::match(['get', 'post'], '/settings/notification', 'Setting\SettingController@notificationSetting')->name('settings.notification');

        //redirect settings
        Route::match(['get', 'post'], '/settings/redirect', 'Setting\SettingController@redirectSetting')->name('settings.redirect');
        /**
         * Users
         */
        Route::get('/users', 'UserController@view')->name('user.view')->middleware('permission:Users view');//all users

        Route::get('kyc-not-filled-user', 'UserController@kycNotFilledView')->name('user.kycNotFilled.view')->middleware('permission:KYC not filled users view'); // KYC not filled user view page
        Route::get('unverified-kyc-user', 'UserController@unverifiedKYCView')->name('user.unverifiedKYC.view')->middleware('permission:Unverified KYC users view'); // Unverified KYC view
        Route::post('change-kyc-status', 'UserController@changeKYCStatus')->name('user.changeKYCStatus')->middleware('permission:KYC accept|KYC reject'); // Change KYC status


        Route::get('/users/profile/{id}', 'UserController@profile')->name('user.profile')->middleware('permission:User profile');
        Route::get('/users/kyc/{id}', 'UserController@kyc')->name('user.kyc')->middleware('permission:User KYC view');
        Route::get('/users/transactions/{id}', 'UserController@transaction')->name('user.transaction')->middleware('permission:User transactions');

        Route::post('/user/deactivate', 'UserController@deactivateUser')->name('user.deactivate')->middleware('permission:User deactivate'); //deactivate user
        Route::post('/user/activate', 'UserController@activateUser')->name('user.activate')->middleware('permission:User activate');
        Route::get('/deactivate-user', 'UserController@deactivateUsersList')->name('user.deactivate.list')->middleware('permission:Deactivate users view');

        Route::get('/user/bank-accounts/{id}', 'UserController@bankAccount')->name('user.bank.accounts');

        Route::get('/user/locked', 'LockedUserController@index')->name('user.locked.list')->middleware('permission:Locked users view');
        Route::get('/user/login-attempts/{id}', 'LockedUserController@loginAttempts')->name('user.login.attempts')->middleware('permission:Locked user login attempts view');
        Route::post('/user/update-login-attempt', 'LockedUserController@updateLoginAttempts')->name('user.loginAttemptsUpdate')->middleware('permission:Locked user login attempt enable');

        Route::get('/user/profile/filter/transaction', 'UserController@filterTransaction')->name('filter.profile.transaction');

        Route::post('/user/profile/user-graph-data', 'UserController@userYearlyGraph')->name('user.yearly.graph');
        Route::post('/user/profile/user-vendor-graph-data', 'UserController@userYearlyVendorGraph')->name('user.yearly.vendor.graph');

        Route::post('/user/update-referral-code/{id}', 'UserController@referralCode')->name('user.referralCode');
        Route::post('/user/update-referral-bonuses/{id}', 'UserController@referralBonus')->name('user.referralBonus');
        Route::post('/user/update-card-load-commission/{id}', 'UserController@cardLoadCommission')->name('user.cardLoadCommission');
        /**
         * Force password change
         */
        Route::post('/force-password-change', 'Auth\ForcePasswordChangeController@forcePasswordChange')->name('user.forcePasswordChange');
        Route::match(['get', 'post'], '/force-group-password-change', 'Auth\ForcePasswordChangeController@groupForcePasswordChange' )->name('group.forcePasswordChange');

        /**
         * Agents
         */
        Route::get('/agents', 'AgentController@view')->name('agent.view');
        Route::match(['get', 'post'],'/agent/create', 'AgentController@create')->name('agent.create');
        Route::match(['get', 'post'], '/agent/edit/{id}', 'AgentController@edit')->name('agent.edit');
        Route::post('/agent/delete/{id}', 'AgentController@delete')->name('agent.delete');

        //agent type
        Route::get('agent-types', 'AgentTypeController@view')->name('agent.type.view');
        Route::match(['get', 'post'],'/agent-type/create', 'AgentTypeController@create')->name('agent.type.create');
        Route::match(['get', 'post'],'/agent-type/update/{agentType}', 'AgentTypeController@update')->name('agent.type.update');

        Route::post('/agent-type/delete/{id}', 'AgentTypeController@delete')->name('agent.type.delete');
        Route::match(['get', 'post'],'/agent-type/cashback/{id}', 'AgentTypeController@cashback')->name('agent.type.cashback');
        Route::match(['get', 'post'],'/agent-type/limit/{id}', 'AgentTypeController@limit')->name('agent.type.limit');

        /**
         * BankLists
         */
        Route::get('/banks/list', 'BankListController@bankList')->name('bankList')->middleware('permission:Bank list view');
        Route::get('/banks/profile', 'BankListController@profile')->name('bank.profile')->middleware('permission:Bank list profile');

        /**
         * Transactions
         */
        Route::get('transaction/complete', 'TransactionController@complete')->name('transaction.complete')->middleware('permission:Complete transaction view');

        //Fund Request
        Route::get('/transaction/fund-request' , 'TransactionController@fundRequest')->name('fundRequest')->middleware('permission:Fund request view');
        Route::get('/transaction/fund-request/detail/{id}', 'TransactionController@fundRequestDetail')->name('fundRequest.detail')->middleware('permission:Fund request detail');

        //User To User Fund Transfer
        Route::get('/transaction/user-to-user-fund-transfer', 'TransactionController@userToUserFundTransfer')->name('transaction.userToUserFundTransfer')->middleware('permission:Fund transfer view');
        Route::get('/transaction/user-to-user-fund-transfer/detail/{id}', 'TransactionController@userToUserFundTransferDetail')->name('userToUserFundTransfer.detail')->middleware('permission:Fund transfer detail');

        //e banking (NPAY)
        Route::get('/transaction/e-banking' , 'TransactionController@eBanking')->name('eBanking')->middleware('permission:EBanking view');
        Route::get('transaction/e-banking/detail/{id}', 'TransactionController@eBankingDetail')->name('eBanking.detail')->middleware('permission:EBanking detail|Failed npay detail');

        //paypoint (Utility)
        Route::get('/transaction/paypoint', 'TransactionController@paypoint')->name('paypoint')->middleware('permission:Paypoint view');
        Route::get('transaction/paypoint/detail/{id}', 'TransactionController@paypointDetail')->name('paypoint.detail')->middleware('permission:Paypoint detail|Failed paypoint detail');

        //NchlBankTransfer
        Route::get('/transaction/nchl-bank-transfer', 'TransactionController@nchlBankTransfer')->name('nchl.bankTransfer');
        Route::get('transaction/nchl-bank-transfer/detail/{id}', 'TransactionController@nchlBankTransferDetail')->name('nchl.bankTransfer.detail');

        //Nchl Aggregated
        Route::get('transaction/nchl-aggregated-payment/detail/{id}', 'TransactionController@nchlAggregatedPaymentDetail')->name('nchl.aggregatedPayment.detail');

        //Reimburse
        Route::get('/transaction/reimburse-transaction', 'TransactionController@reimburseTransaction')->name('reimburse.transaction');
        Route::get('transaction/reimburse-transaction/detail/{id}', 'TransactionController@reimburseTransactionDetail')->name('reimburse.transaction.detail');


        //NchlLoadTransaction
        Route::get('/transaction/nchl-load-transaction', 'TransactionController@nchlLoadTransaction')->name('nchl.loadTransaction');
        Route::get('transaction/nchl-load-transaction/detail/{id}', 'TransactionController@nchlLoadTransactionDetail')->name('nchl.loadTransaction.detail');

        //NicAsia CyberSource
        Route::get('transaction/nicasia-cybesource-load-transaction','TransactionController@nicAsiaCyberSourceLoad')->name('nicasia.cyberSourceLoad');
        Route::get('transaction/nicasia-cybesource-load-transaction/detail/{id}', 'TransactionController@nicAsiaCyberSourceLoadDetail')->name('nicasia.cyberSourceLoadTransaction.detail');

        //Khalti
        Route::get('transaction/khalti-payment-transaction/detail/{id}', 'TransactionController@khaltiPaymentDetail')->name('khalti.payment.detail');


        Route::get('/transaction-detail', 'TransactionController@transactionDetail')->name('transactionDetail');


        //failed transaction
        Route::get('/failed-user-transaction', 'TransactionController@failedUserTransaction')->name('userTransaction.failed')->middleware('permission:Failed paypoint view');
        Route::get('/failed-user-load-transaction', 'TransactionController@failedUserLoadTransaction')->name('userLoadTransaction.failed')->middleware('permission:Failed npay view');



        /**
         * Clearance
         */

        // Latest Clearance using OOP
        Route::post('/clearance/npay-clearance', 'ClearController@nPay')->name('clearance.nPay');
        Route::post('/clearance/payPoint-clearance', 'ClearController@payPoint')->name('clearance.payPoint');
        // Latest Clearance using OOP

        Route::get('/clearance/npay', 'NPayClearanceController@npay')->name('clearance.npay')->middleware('permission:Clearance npay');
        Route::get('/clearance/paypoint', 'PayPointClearanceController@paypoint')->name('clearance.paypoint')->middleware('permission:Clearance paypoint');

        Route::get('/clearance/npay-transactions/{date}', 'NPayClearanceController@npayTransactions')->name('clearance.npay.transactions')->middleware('permission:Clearance npay'/*, 'check_clearance_otp:npay'*/);
        Route::get('/clearance/paypoint-transactions/{date}', 'PayPointClearanceController@paypointTransactions')->name('clearance.paypoint.transactions')->middleware('permission:Clearance paypoint'/*, 'check_clearance_otp:paypoint'*/);

        Route::post('/clearance/clear', 'ClearanceController@clear')->name('clearance.clear')->middleware('permission:Clearance npay clear transaction|Clearance paypoint transaction');
        Route::get('/clearance/npay-report', 'NPayClearanceController@npayReport')->name('clearance.npayReport')->middleware('permission:Clearance npay');
        Route::get('/clearance/paypoint-report', 'PayPointClearanceController@paypointReport')->name('clearance.paypointReport')->middleware('permission:Clearance paypoint');

        //otp
        Route::match(['get', 'post'], '/npay-clearance/otp', 'NPayClearanceController@npayClearanceOTP')->name('npay.clearance.otp');
        Route::match(['get', 'post'], '/paypoint-clearance/otp', 'PayPointClearanceController@paypointClearanceOTP')->name('paypoint.clearance.otp');

        //generate clearance report
        Route::get('/npay-generate-clearance-report/{clearance_id}', 'NPayClearanceController@generateReport')->name('npay.generateClearanceReport');
        Route::get('/paypoint-generate-clearance-report/{clearance_id}', 'PayPointClearanceController@generateReport')->name('paypoint.generateClearanceReport');


        /**
         * View Clearance
         */
        Route::get('/view-npay-clearance', 'NPayClearanceController@npayView')->name('clearance.npayView')->middleware('permission:Clearance npay view');
        Route::get('/view-paypoint-clearance', 'PayPointClearanceController@paypointView')->name('clearance.paypointView')->middleware('permission:Clearance paypoint view');

        Route::match(['get', 'post'],'/change-clearance-status/{clearance_id}', 'ClearanceController@changeStatus')->name('clearance.changeStatus')->middleware('permission:Clearance npay change status|Clearance paypoint change status');

        //Route::get('/clearance-transactions/{clearance}', 'ClearanceController@transactions')->name('clearance.transactions')->middleware('permission:Clearance npay transactions view|Clearance paypoint transactions view');
        Route::get('/npay-clearance-transactions/{clearance}', 'ClearanceController@nPayTransactions')->name('npay.clearance.transactions');
        Route::get('/paypoint-clearance-transactions/{clearance}', 'ClearanceController@payPointTransactions')->name('paypoint.clearance.transactions');

        /**
         * Dispute
         */
        //Route::match(['get', 'post'],'/disputed-transaction/{disputedTransaction}', 'DisputeController@handle')->name('dispute.handle');


        Route::match(['get', 'post'],'single-dispute', 'DisputeController@singleDisputeView')->name('dispute.singleTransaction')->middleware('permission:Dispute create');
        Route::post('/create-single-dispute', 'DisputeController@createSingleDispute')->name('dispute.createSingleTransaction')->middleware('permission:Dispute create');

        Route::get('/view-all-dispute', 'DisputeController@viewAll')->name('dispute.view.all')->middleware('permission:Dispute view');
        Route::get('/dispute-detail/{disputeId}', 'DisputeController@disputeDetail')->name('dispute.detail')->middleware('permission:Dispute detail view|Dispute handle single');
        Route::get('/dispute-clearance-detail/{disputeId}', 'DisputeController@disputeClearanceDetail')->name('dispute.detail.clearance')->middleware('permission:Clearance npay handle dispute|Clearance paypoint handle dispute');
        Route::post('/create-handle-dispute/', 'DisputeController@createHandleDispute')->name('dispute.createHandle')->middleware('permission:Dispute handle single');

        Route::post('/reject-automatic-handle-dispute', 'DisputeController@rejectDispute')->name('dispute.reject')->middleware('permission:Dispute reject');
        Route::post('/accept-automatic-handle-dispute', 'DisputeController@acceptDispute')->name('dispute.accept')->middleware('permission:Dispute accept');

        /**
         * Audit Trails
         */
        Route::get('/audit-trails/all-transaction', 'AuditTrailController@all')->name('auditTrail.all')->middleware('permission:View all audit trial');
        Route::get('/audit-trails/nPay', 'AuditTrailController@nPay')->name('auditTrail.nPay')->middleware('permission:View npay audit trial');
        Route::get('/audit-trails/payPoint', 'AuditTrailController@payPoint')->name('auditTrail.payPoint')->middleware('permission:View paypoint audit trial');
        Route::get('/audit-trails/nchl-bank-transfer', 'AuditTrailController@nchlBankTransfer')->name('auditTrail.nchl.bankTransfer');
        Route::get('/audit-trails/nchl-load-transaction', 'AuditTrailController@nchlLoadTransaction')->name('auditTrail.nchl.loadTransaction');


        /**
         * Logs
         */
        Route::get('/logs/user-session', 'LogController@userSession')->name('admin.log.userSession')->middleware('permission:User session log view');
        Route::get('/logs/merchant-session', 'LogController@merchantSession')->name('admin.log.merchantSession');
        Route::get('/logs/auditing', 'LogController@auditing')->name('admin.log.auditing')->middleware('permission:Auditing log view');
        Route::get('/logs/profiling', 'LogController@profiling')->name('admin.log.profiling')->middleware('permission:Profiling log view');
        Route::get('/logs/statistics', 'LogController@statistics')->name('admin.log.statistics')->middleware('permission:Statistics log view');
        Route::get('/logs/development', 'LogController@development')->name('admin.log.development')->middleware('permission:Development log view');


        /**
         * Pay Points
         */
        Route::get('/paypoint/daily', 'PayPointController@daily')->name('paypoint.daily');
        Route::get('/paypoint/monthly', 'PayPointController@monthly')->name('paypoint.monthly');
        Route::get('/paypoint/yearly', 'PayPointController@yearly')->name('paypoint.yearly');

        /**
         * load test fund
         */
        Route::get('/load-test-fund', 'LoadTestFundController@index')->name('loadTestFund.index');
        Route::match(['get', 'post'], '/load-test-fund/create', 'LoadTestFundController@create')->name('loadTestFund.create');


        /**
         * Repost transaction
         */
        Route::match(['get', 'post'], '/repost/npay', 'RepostController@npay')->name('repost.npay');


        /**
         * Report
         */
        Route::get('/report/monthly', 'ReportController@monthly')->name('report.monthly')->middleware('permission:Monthly report view');
        Route::get('/report/yearly', 'ReportController@yearly')->name('report.yearly')->middleware('permission:Yearly report view');
        //report (npay, paypoint)
        Route::get('/report/paypoint', 'ReportController@paypoint')->name('report.paypoint');
        Route::get('/report/npay', 'ReportController@npay')->name('report.npay');

        //Graph
        Route::post('/report/monthly/transaction-graph-data', 'GraphReportController@monthlyTransactionGraph')->name('report.monthly.graph');
        Route::post('/report/yearly/transaction-graph-data', 'GraphReportController@yearlyTransactionGraph')->name('report.yearly.graph');

        Route::post('/report/monthly/vendor-graph-data', 'GraphReportController@monthlyVendorGraph')->name('report.monthly.vendor.graph');
        Route::post('/report/yearly/vendor-graph-data', 'GraphReportController@yearlyVendorGraph')->name('report.yearly.vendor.graph');

        /**
         * Notification
         */
        Route::get('/notification/view', "NotificationController@view")->name('notification.view')->middleware('permission:Notification view');
        Route::match(['get', 'post'],'/notification/create', "NotificationController@create")->name('notification.create')->middleware('permission:Notification create');

        Route::post('send-user-notification/{user}', "NotificationController@userNotification")->name('notification.user')->middleware('permission:Send notification to user');


        /**
         * Group Notification
         */
        Route::match(['get', 'post'],'/create-notification-group', 'GroupNotificationController@createGroup')->name('group.notification.createGroup');

        /**
         * Sparrow sms
         */
        Route::get('/sparrow-sms', 'SparrowSMSController@index')->name('sparrow.view')->middleware('permission:Sparrow SMS view');
        Route::get('/sparrow-sms/detail', 'SparrowSMSController@detail')->name('sparrow.detail');

        /**
         * Terms and Condition
         */
        Route::get('/terms-and-condition/', 'TermsAndConditionController@view')->name('termsAndCondition.view')->middleware('permission:Terms and condition view');
        Route::match(['get','post'], '/terms-and-condition/edit', 'TermsAndConditionController@edit')->name('termsAndCondition.edit')->middleware('permission:Terms and condition update');


        Route::get('/development-tool', 'DevelopmentToolController@index')->name('developmentTool.index')->middleware('permission:Development tools view');
        Route::get('/development-tool/backup', 'DevelopmentToolController@backup')->name('developmentTool.backup')->middleware('permission:Development tool backup database');


        /**
         * Export to excel
         */
        Route::get('/excel/complete-transaction', 'ExcelExportController@completeTransactions')->name('transaction.complete.excel');
        Route::get('/excel/yearly-report', 'ExcelExportController@yearlyReport')->name('report.yearly.excel');
        Route::get('/excel/monthly-report', 'ExcelExportController@monthlyReport')->name('report.monthly.excel');

        Route::get('/excel/users', 'ExcelExportController@users')->name('user.excel');

        Route::get('/excel/fund-transfer', 'ExcelExportController@fundTransfer')->name('fundTransfer.excel');
        Route::get('/excel/fund-request', 'ExcelExportController@fundREquest')->name('fundRequest.excel');

        Route::get('/excel/npay', 'ExcelExportController@nPay')->name('npay.excel');
        Route::get('/excel/paypoint', 'ExcelExportController@payPoint')->name('paypoint.excel');

        //user
        Route::get('/excel/complete-transaction/user', 'ExcelExportController@userCompleteTransactions')->name('user.transaction.complete.excel');
        Route::get('/excel/npay/user', 'ExcelExportController@userNPay')->name('user.npay.excel');

        //failed
        Route::get('/excel/npay-failed', 'ExcelExportController@failedNPay')->name('failed.npay.excel');
        Route::get('/excel/paypoint-failed', 'ExcelExportController@failedPayPoint')->name('failed.paypoint.excel');

        //clearance
        Route::get('/excel/npay-clearance', 'ExcelExportController@nPayClearance')->name('clearance.npay.excel');
        Route::get('/excel/paypoint-clearance', 'ExcelExportController@payPointClearance')->name('clearance.paypoint.excel');

        //clearance transactions
        Route::get('/excel/clearance-transaction', 'ExcelExportController@clearanceTransaction')->name('clearance.transaction.excel');

        //sparrow sms
        Route::get('/excel/sparrow-sms', 'ExcelExportController@sparrowSMS')->name('sparrowSMS.excel');

        //dispute
        Route::get('/excel/dispute-transactions', 'ExcelExportController@disputes')->name('dispute.excel');

        Route::get('/excel/user-all-audit-trial/{id}', 'ExcelExportController@userAllAuditTrail')->name('user.allAuditTrial.excel');

        Route::get('/excel/dpaisa-all-audit-trial', 'ExcelExportController@dpaisaAllAuditTrail')->name('dpaisa.allAuditTrail.excel');
        Route::get('/excel/dpaisa-npay-audit-trial', 'ExcelExportController@dpaisaNPayAuditTrail')->name('npayAuditTrail.excel');
        Route::get('/excel/dpaisa-paypoint-audit-trial', 'ExcelExportController@dpaisaPPAuditTrail')->name('ppAuditTrail.excel');


        /**
         * General Settings
         */
        Route::get('general-setting', 'GeneralSettingController@index')->name('general.setting.index')->middleware('permission:General page setting view');
        Route::match(['get','post'],'general-setting/create', 'GeneralSettingController@create')->name('general.setting.create')->middleware('permission:General page setting create');
        Route::match(['get','post'],'general-setting/update/{id}', 'GeneralSettingController@update')->name('general.setting.update')->middleware('permission:General page setting update');
        Route::post('general-setting/delete/', 'GeneralSettingController@delete')->name('general.setting.delete')->middleware('permission:General page setting delete');

        /**
         * Frontend
         */
        //header
        Route::match(['get', 'post'],'frontend/header', 'Frontend\HeaderController@index')->name('frontend.header');

        //services
        Route::get('frontend/services', 'Frontend\ServiceController@index')->name('frontend.service.index');
        Route::match(['get','post'],'frontend/service/create', 'Frontend\ServiceController@create')->name('frontend.service.create');
        Route::match(['get','post'],'frontend/service/update/{id}', 'Frontend\ServiceController@update')->name('frontend.service.update');
        Route::post('frontend/service/delete/', 'Frontend\ServiceController@delete')->name('frontend.service.delete');

        //abouts
        Route::get('frontend/abouts', 'Frontend\AboutController@index')->name('frontend.about.index');
        Route::match(['get','post'],'frontend/about/create', 'Frontend\AboutController@create')->name('frontend.about.create');
        Route::match(['get','post'],'frontend/about/update/{id}', 'Frontend\AboutController@update')->name('frontend.about.update');
        Route::post('frontend/about/delete/', 'Frontend\AboutController@delete')->name('frontend.about.delete');

        //Process
        Route::get('frontend/processes', 'Frontend\ProcessController@index')->name('frontend.process.index');
        Route::match(['get','post'],'frontend/process/create', 'Frontend\ProcessController@create')->name('frontend.process.create');
        Route::match(['get','post'],'frontend/process/update/{id}', 'Frontend\ProcessController@update')->name('frontend.process.update');
        Route::post('frontend/process/delete/', 'Frontend\ProcessController@delete')->name('frontend.process.delete');

        //Banner
        Route::get('frontend/banner', 'Frontend\BannerController@index')->name('frontend.banner.index');
        Route::match(['get','post'],'frontend/banner/create', 'Frontend\BannerController@create')->name('frontend.banner.create');
        Route::match(['get','post'],'frontend/banner/update/{id}', 'Frontend\BannerController@update')->name('frontend.banner.update');
        Route::post('frontend/banner/delete/', 'Frontend\BannerController@delete')->name('frontend.banner.delete');

        //Contact Us
        Route::match(['get', 'post'],'frontend/contact-us', 'Frontend\ContactController@index')->name('frontend.contact');
    });
});
