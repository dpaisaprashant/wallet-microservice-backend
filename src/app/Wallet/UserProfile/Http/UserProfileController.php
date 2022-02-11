<?php

namespace App\Wallet\UserProfile\Http;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminUserKYC;
use App\Models\NICAsiaCyberSourceLoadTransaction;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\UserBonus;
use App\Models\UserCommissionValue;
use App\Models\UserKYC;
use App\Models\UserLoadTransaction;
use App\Models\Wallet;
use App\Traits\CollectionPaginate;
use App\Wallet\AuditTrail\AuditTrial;
use App\Wallet\AuditTrail\Behaviors\BAll;
use App\Wallet\AuditTrail\Behaviors\BLoginHistory;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    use CollectionPaginate;

    private function loginHistoryAudits($user)
    {
        $IBehaviour = new BLoginHistory();
        $auditTrial = new AuditTrial($IBehaviour);
        return $auditTrial->createTrial($user);
    }

    private function allAudits($user, $request)
    {
        $IBehaviour = new BAll(); //get audit data from all transactions/user activity tables
        $auditTrial = new AuditTrial($IBehaviour);
        return $this->collectionPaginate(50, $auditTrial->setRequest($request)->createTrial($user), $request, 'all-audit-trials');
    }

    public function userProfile($id, Request $request){

        $length = 15;
        $activeTab = 'kyc';
        if ($request->has('user-load-fund') || $request->transaction_type === 'user-load-fund') {
            $activeTab = 'loadFund';
        }
        if ($request->has('user-transaction-event') || $request->transaction_type === 'user-transaction-event') {
            $activeTab = 'transaction';
        }
        if ($request->has('all-audit-trials') || $request->transaction_type === 'all-audit-trials') {
            $activeTab = 'allAuditTrial';
        }

        if ($request->has('user-login-history-audit') || $request->transaction_type === 'user-login-history-audit') {
            $activeTab = 'userLoginHistoryAudit';
        }


        //$user = User::with(['userLoadTransactions', 'userLoginHistories', 'userCheckPayment', 'fromFundTransfers', 'receiveFundTransfers', 'fromFundRequests', 'receiveFundRequests', 'kyc', 'wallet'])->findOrFail($id);
        $user = User::with(['userReferral', 'userReferralLimit', 'merchant', 'bankAccount', 'preTransactions', 'requestInfos', 'userLoginHistories', 'fromFundTransfers', 'receiveFundTransfers', 'fromFundRequests', 'receiveFundRequests', 'kyc', 'wallet', 'agent', 'userReferralBonus'])->findOrFail($id);
        $userBonus = UserBonus::whereHas('user')->where('user_id', $id)->first()->bonus;
        $userBonusBalance = Wallet::whereHas('user')->where('user_id', $id)->first()->bonus_balance;
        $admin = $request->user();
        if (!$admin->hasPermissionTo('User profile')) {

            //merchant
            if ($user->merchant) {
                if (!$admin->hasPermissionTo('Merchant profile')) {
                    abort(403, 'User does not have the right permissions to view merchant profile.');
                }
            }

            //agent
            if ($user->agent) { //has row in agents table but is a verified agent
                if (!$admin->hasPermissionTo('View agent profile')) {
                    abort(403, 'User does not have the right permissions to view agent profile');
                }
            }

            //normal user
            if (empty($user->agent) && empty($user->merchant)) {
                abort(403, 'User does not have the right permissions to view user profile');
            }
        }

        //Audit Trial section
        $allAudits = $this->allAudits($user, $request);
        //$nPayAudits = $this->nPayAudits($user);
        // $payPointAudits = $this->payPointAudits($user);
        $loginHistoryAudits = $this->loginHistoryAudits($user);

        //$userLoadTransactions = UserLoadTransaction::with('commission')->where('user_id', $user->id)->where('status', 'COMPLETED')->latest()->filter($request)->paginate($length,['*'], 'user-load-fund');
        $loadPTIds = TransactionEvent::where('transaction_type', UserLoadTransaction::class)->where('user_id', $user->id)->pluck('pre_transaction_id');
        $userTransactionEvents = TransactionEvent::where('user_id', $user->id)->latest()->filter($request)->paginate($length, ['*'], 'user-transaction-event');
        $userTransactionStatements = TransactionEvent::where('user_id', $user->id)->latest()->filter($request)->paginate($length, ['*'], 'user-transaction-statement');
        $loadFundSum = $user->loadedFundSum();
        $userLoadCommission = (new UserCommissionValue())->getUserCommission($user->id, NICAsiaCyberSourceLoadTransaction::class);
        $user_id = UserKYC::where('user_id', $id)->first();

        if ($user_id != null) {
            $ids = $user_id->id;
            $admin = AdminUserKYC::where('kyc_id', $ids)->orderBy('created_at', 'DESC')->first();
            $admin_id = optional($admin)->admin_id;
            $admin_details = Admin::where('id', $admin_id)->first();
        } else {
            $admin_details = collect(array('nodata'));
            $admin = collect(array('nodata'));
            $admin_data = collect(array('nodata'));
        }
        return view('UserProfile::user_profile')->with(compact('userLoadCommission', 'admin_details', 'admin', 'loginHistoryAudits', 'allAudits', 'user', 'loadFundSum', 'activeTab', 'userTransactionStatements', 'userTransactionEvents', 'userBonus', 'userBonusBalance'));
    }

    public function userKyc($id){
        $user = User::with('kyc')->findOrFail($id);
        $user_id = UserKYC::where('user_id', $id)->first();

        if ($user_id != null) {
            $ids = $user_id->id;
            $admin = AdminUserKYC::where('kyc_id', $ids)->orderBy('created_at', 'DESC')->first();
            $admin_id = optional($admin)->admin_id;
            $admin_details = Admin::where('id', $admin_id)->first();
        } else {
            $admin_details = collect(array('nodata'));
            $admin = collect(array('nodata'));
            $admin_data = collect(array('nodata'));
        }

        return view("UserProfile::kyc")->with(compact('admin_details', 'user'));
//        return [$user,$admin_details];

    }

}
