<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Merchant\Merchant;
use App\Models\MerchantTransaction;
use App\Notifications\SingleMerchantSMSNotification;
use App\Traits\CollectionPaginate;
use App\Wallet\AuditTrail\AuditTrial;
use App\Wallet\AuditTrail\Behaviors\BMerchant;
use App\Wallet\Merchant\Repositories\MerchantKYCRepository;
use App\Wallet\Merchant\Repositories\MerchantRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class MerchantController extends Controller
{

    use CollectionPaginate;

    private function allAudits($user, $request) {
        $IBehaviour = new BMerchant();
        $auditTrial = new AuditTrial($IBehaviour);
        return $this->collectionPaginate(50, $auditTrial->setRequest($request)->createTrial($user), $request, 'all-audit-trials') ;
    }

    public function view(MerchantRepository  $repository)
    {
        $merchants = $repository->paginatedMerchants();
        $stats = $repository->merchantStats();

        return view('admin.merchant.view')->with(compact('merchants','stats'));
    }

    public function transaction($id, MerchantRepository $repository)
    {
        $transactions = $repository->paginatedMerchantTransactions($id);
        $merchant = Merchant::where('id', $id)->first();

        return view('admin.merchant.transaction')->with(compact('transactions', 'merchant'));
    }

    public function kyc($id)
    {
        $merchant = Merchant::with('kyc')->findOrFail($id);
        return view('admin.merchant.kyc')->with(compact('merchant'));
    }

    public function changeKYCStatus(Request $request, MerchantKYCRepository $repository)
    {
        $kycId = $request->get('kyc');
        $kyc = $repository->merchantKYC($kycId);
        if(isset($kyc)) {
            if ($request->accept_status == 'accepted') {
                $repository->acceptKYC($kyc);
            } elseif ($request->status == 'rejected') {
                $repository->rejectKYC($kyc);
            }
        }else{
            return redirect()->back()->with('error','Merchant kyc not found');
        }

        return redirect()->back();
    }

    public function unverifiedMerchantKYCView(MerchantKYCRepository $repository){
        $merchants = $repository->paginatedUnverifiedMerchantKYC();
        return view('admin.merchant.unverifiedMerchantKYC',compact('merchants'));
    }

    public function merchantDetailKyc($id){
        $merchant = User::with('merchant','kyc')->findOrFail($id);
        return view('admin.merchant.kyc',compact('merchant'));
    }


    public function profile($id, Request $request)
    {

        $length = 15;
        $activeTab = 'kyc';
        if ($request->has('user-load-fund') || $request->transaction_type === 'user-load-fund') {
            $activeTab = 'loadFund';
        }
        if ($request->has('user-transaction-event') || $request->transaction_type === 'user-transaction-event'){
            $activeTab = 'transaction';
        }
        if ($request->has('all-audit-trials') || $request->transaction_type === 'all-audit-trials'){
            $activeTab = 'allAuditTrial';
        }

        if ($request->has('user-login-history-audit') || $request->transaction_type === 'user-login-history-audit'){
            $activeTab = 'userLoginHistoryAudit';
        }


        $merchant = User::with(['kyc', 'wallet', 'bankAccount'])->whereHas('merchant')->whereHas('kyc')->findOrFail($id);
//        dd($merchant);
//        $allAudits = $this->allAudits($merchant, $request);

//        $loadFundSum = MerchantTransaction::whereMerchantId($id)->whereStatus(MerchantTransaction::STATUS_COMPLETE)->sum('amount') / 100;

        return view('admin.merchant.profile')->with(compact('merchant',  'activeTab'));
    }

    public function merchantNotification(Merchant $merchant, Request $request)
    {
        $merchant->notify(new SingleMerchantSMSNotification($request->message, $merchant));
        return redirect()->back()->with('success', 'SMS sent successfully');
    }

    public function merchantCommission(User $merchant, Request $request)
    {


        //if (!empty($request->commission_type) && !empty($request->commission_value)) {
        $updateMerchant = $merchant->merchant;
        $commission = $updateMerchant->update([
            'commission_type' => $request->commission_type,
            'commission_value' => $request->commission_value,

            'scan_cashback_type' => $request->scan_cashback_type,
            'scan_cashback_value' => $request->scan_cashback_value,

            'portal_cashback_type' => $request->portal_cashback_type,
            'portal_cashback_value' => $request->portal_cashback_value,
        ]);

        return redirect()->back()->with('success', 'Commission for the merchant updated successfully');
        // }

        //return redirect()->back()->with('error', 'Error while updating commission for the merchant');

    }

    public function merchantMinBankTransferBalance(Merchant $merchant, Request $request)
    {

        if (!empty($request->min_balance_for_bank_transfer)) {
            $merchant->update([
                'min_balance_for_bank_transfer' => $request->min_balance_for_bank_transfer,
            ]);

            return redirect()->back()->with('success', 'Min Bank Transfer balance for the merchant updated successfully');
        }

        return redirect()->back()->with('error', 'Error while updating Min Bank Transfer balance for the merchant');

    }

    public function merchantBankAccount(Merchant $merchant, Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        if ($merchant->bankAccount){
            $updated = $merchant->bankAccount->update($data);
            if ($updated) {
                return redirect()->back()->with('success', 'Bank Account updated successfully');
            }
        }

        return redirect()->back()->with('success', 'Error while updating bankaccount');
    }
}
