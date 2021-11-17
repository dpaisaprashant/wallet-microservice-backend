<?php


namespace App\Wallet\Merchant\Repositories;


use App\Models\Merchant\Merchant;
use App\Models\MerchantTransactionEvent;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;
use App\Models\User;
class MerchantRepository
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
     * @return MerchantRepository
     */
    public function setLength(int $length)
    {
        $this->length = $length;
        return $this;
    }

    private function wallerBalanceSorted()
    {
        $unsortedUsers = User::with('wallet','merchant')->whereHas('merchant')->filter($this->request)->get();

        $users = $unsortedUsers->map(function ($value, $key) {
            $value['balance'] = $value->wallet->balance;
            return $value;
        })->sortByDesc('balance');

        return $this->collectionPaginate($this->length, $users, $this->request);
    }
    private function sortedUsers()
    {
        return User::with('wallet','merchant')->whereHas('merchant')->filter($this->request)->paginate($this->length);
    }

    private function latestUsers()
    {
        return User::with('wallet','merchant')->whereHas('merchant')->latest()->filter($this->request)->paginate($this->length);
    }


    public function paginatedMerchants()
    {
        if ($this->request->sort == 'wallet_balance')
        {
            return $this->wallerBalanceSorted();

        } elseif(empty($this->request->sort))
        {
            return $this->latestUsers();
        }else{
            return $this->sortedUsers();
        }
    }

    public function insertIntoMerchantReseller(){
        return 'ok';
    }

    private function merchantSortedTransactions($id)
    {
        return MerchantTransactionEvent::where('merchant_id' , $id)
            ->with('transactionable')
            ->filter($this->request)
            ->paginate($this->length);
    }

    private function merchantLatestTransaction($id)
    {
        return MerchantTransactionEvent::where('merchant_id' , $id)
            ->with('transactionable')
            ->latest()
            ->filter($this->request)
            ->paginate($this->length);
    }

    public function paginatedMerchantTransactions($id)
    {
        if (empty($this->request->sort)) {
            return $this->merchantLatestTransaction($id);
        } else {
            return $this->merchantSortedTransactions($id);
        }
    }

    public function merchantStats()
    {
        $repository = new MerchantStatsRepository();
        return [
            'validMerchantCount' => $repository->validKYCMerchantCount(),
            'invalidMerchantCount' => $repository->invalidKYCMerchantCount(),
            'successfulMerchantTransactionCount' => $repository->successfulMerchantTransactionCount(),
            'successfulMerchantTransactionSum' => $repository->successfulMerchantTransactionSum()
        ];
    }

    public function rejectedKycUsers(){
        $rejectedKycUsers = User::with('wallet', 'userType','merchant','agent','kyc')->whereHas('userType')->whereHas('merchant')->whereHas('kyc',function($query){
            return $query->where('accept',0);
        })->filter(request())->get();
        return $this->collectionPaginate($this->length,$rejectedKycUsers,$this->request);
    }

    public function acceptedKycUsers(){
        $acceptedKycUsers = User::with('wallet', 'userType','merchant','agent','kyc')->whereHas('userType')->whereHas('merchant')->whereHas('kyc',function($query){
            return $query->where('accept',1);
        })->filter(request())->get();
        return $this->collectionPaginate($this->length,$acceptedKycUsers,$this->request);
    }

    public function pendingKycUsers(){
        $pendingKycUsers = User::with('wallet', 'userType','merchant','agent','kyc')->whereHas('userType')->whereHas('merchant')->whereHas('kyc',function($query){
            return $query->where('accept',null);
        })->filter(request())->get();
        return $this->collectionPaginate($this->length,$pendingKycUsers,$this->request);
    }

    public function kycNotFilledUsers(){
        $kycNotFilledUsers = User::with('wallet', 'userType','merchant','agent','kyc')->whereHas('userType')->whereHas('merchant')->doesntHave('kyc')->filter(request())->get();
        return $this->collectionPaginate($this->length,$kycNotFilledUsers,$this->request);
    }
}
