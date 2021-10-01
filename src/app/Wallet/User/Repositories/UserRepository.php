<?php


namespace App\Wallet\User\Repositories;


use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\UserBankAccount;
use App\Models\UserKYC;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;

class UserRepository
{
    use CollectionPaginate;

    private $request;

    private $length = 15;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param int $length
     * @return UserRepository
     */
    public function setLength(int $length): UserRepository
    {
        $this->length = $length;
        return $this;
    }

    private function wallerBalanceSorted()
    {
        $unsortedUsers = User::with('wallet', 'userType','merchant','agent')->whereHas('userType')->filter($this->request)->get();
        $users = $unsortedUsers->map(function ($value, $key) {
            $value['balance'] = $value->wallet->balance;
            return $value;
        })->sortByDesc('balance');

        return $this->collectionPaginate($this->length, $users, $this->request);
    }

    private function transactionPaymentSorted()
    {
        $unsortedUsers = User::with('wallet', 'userType','merchant','agent')->whereHas('userType')->filter($this->request)->get();
        $users = $unsortedUsers->map(function (User $value, $key) {
            $value['amount_sum'] = $value->totalTransactionPaymentAmount();
            return $value;
        })->sortByDesc('amount_sum');

        return $this->collectionPaginate($this->length, $users, $this->request);
    }

    public function rejectedKycUsers(){
        $rejectedKycUsers = User::with('wallet', 'userType','merchant','agent','kyc')->whereHas('userType')->whereHas('kyc',function($query){
            return $query->where('accept',0);
        })->get();
        return $this->collectionPaginate($this->length,$rejectedKycUsers,$this->request);
    }

    public function acceptedKycUsers(){
        $acceptedKycUsers = User::with('wallet', 'userType','merchant','agent','kyc')->whereHas('userType')->whereHas('kyc',function($query){
            return $query->where('accept',1);
        })->get();
        return $this->collectionPaginate($this->length,$acceptedKycUsers,$this->request);
    }

    public function pendingKycUsers(){
        $pendingKycUsers = User::with('wallet', 'userType','merchant','agent','kyc')->whereHas('userType')->whereHas('kyc',function($query){
            return $query->where('accept',null);
        })->get();
        return $this->collectionPaginate($this->length,$pendingKycUsers,$this->request);
    }

    public function kycNotFilledUsers(){
        $kycNotFilledUsers = User::with('wallet', 'userType','merchant','agent','kyc')->whereHas('userType')->doesntHave('kyc')->get();
        return $this->collectionPaginate($this->length,$kycNotFilledUsers,$this->request);
    }

    private function transactionLoadSorted()
    {
        $unsortedUsers = User::with('wallet', 'userType','merchant','agent')->whereHas('userType')->filter($this->request)->get();
        $users = $unsortedUsers->map(function (User $value, $key) {
            $value['amount_sum'] = (float) $value->totalLoadFundAmount();
            return $value;
        })->sortByDesc('amount_sum');

        return $this->collectionPaginate($this->length, $users, $this->request);
    }

    private function sortedUsers()
    {
        return User::with('wallet', 'userType','merchant','agent')->whereHas('userType')->filter($this->request)->paginate($this->length);
    }

    private function latestUsers()
    {
        return User::with('wallet', 'userType','merchant','agent')->whereHas('userType')->latest()->filter($this->request)->paginate($this->length);

    }

    public function paginatedUsers()
    {
        if ($this->request->sort == 'wallet_balance')
        {
            return $this->wallerBalanceSorted();
        }elseif($this->request->sort == 'transaction_payment')
        {
            return $this->transactionPaymentSorted();
        } elseif($this->request->sort == 'transaction_loaded')
        {
            return $this->transactionLoadSorted();
        } elseif(empty($this->request->sort))
        {
            return $this->latestUsers();
        }else{
            return $this->sortedUsers();
        }
    }

    public function paginatedDeactivateUsers()
    {
        return User::with('wallet')->whereStatus(0)->latest()->filter($this->request)->paginate($this->length);
    }

    public function bankAccounts($id)
    {
        return UserBankAccount::whereUserId($id)->latest()->get();
    }

    private function userSortedTransactions($id)
    {
        return TransactionEvent::where('user_id' , $id)
            ->with('transactionable')
            ->filter($this->request)
            ->paginate($this->length);
    }

    private function userLatestTransaction($id)
    {
        return TransactionEvent::where('user_id' , $id)
            ->with('transactionable')
            ->latest()
            ->filter($this->request)
            ->paginate($this->length);
    }

    public function paginatedUserTransactions($id)
    {
        if (empty($this->request->sort)) {
           return $this->userLatestTransaction($id);
        } else {
           return $this->userSortedTransactions($id);
        }
    }

    /*
    * -------------------------
    * USER Query Builder
    * -------------------------
    */
    public function kycUnfilledQuery()
    {
        return (new User())->kycNotFilledUsers();
    }

    public function kycAcceptedQuery()
    {
        return User::whereHas('kyc', function ($query) {
            return $query->where('accept', 1);
        });
    }

    public function kycRejectedQuery()
    {
        return User::whereHas('kyc', function ($query) {
            return $query->where('accept', 0);
        });
    }

    public function kycUnverifiedQuery()
    {
        return User::whereHas('kyc', function ($query) {
            return $query->where('accept', null);
        });
    }

}
