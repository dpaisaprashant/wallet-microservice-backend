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
}
