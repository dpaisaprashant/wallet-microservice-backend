<?php


namespace App\Wallet\PayPoint\Repository;

use App\Models\UserCheckPayment;
use App\Models\UserTransaction;
use App\Traits\CollectionPaginate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PayPointRepository
{
    use CollectionPaginate;

    private $request;

    private  $length = 15;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param int $length
     * @return PayPointRepository
     */
    public function setLength(int $length): PayPointRepository
    {
        $this->length = $length;
        return $this;
    }

    private function sortedTransactions()
    {
        return UserCheckPayment::with('userExecutePayment', 'userTransaction', 'user', 'preTransaction', 'requestInfo')->filter($this->request)->paginate($this->length);
    }

    private function amountSortedTransactions()
    {
        $unsortedTransactions = UserCheckPayment::with('userExecutePayment', 'userTransaction', 'user', 'preTransaction', 'requestInfo')->filter($this->request)->get();

        $transactions = $unsortedTransactions->map(function (UserCheckPayment $value, $key) {
            $value['amount'] = $value->userTransaction['amount'] ?? null;
            return $value;
        })->sortByDesc('amount');

        return $this->collectionPaginate($this->length, $transactions, $this->request);
    }

    private function latestTransactions()
    {
        return UserCheckPayment::with('userExecutePayment', 'userTransaction', 'user', 'preTransaction', 'requestInfo')->latest()->filter($this->request)->paginate($this->length);
    }

    private function failedSortedTransactions()
    {
        return (new UserTransaction())->getFailedUserTransactions()->filter($this->request)->paginate($this->length);
    }

    private function failedLatestTransactions()
    {
        return (new UserTransaction())->getFailedUserTransactions()->latest()->filter($this->request)->paginate($this->length);
    }

    public function paginatedTransactions()
    {
        if (empty($this->request->sort)) {
            return $this->latestTransactions();
        } else {
            if ($this->request->sort == 'amount') {
                return $this->amountSortedTransactions();
            } else {
                return $this->sortedTransactions();
            }
        }
    }

    public function paginatedFailedTransaction()
    {
        if (empty($this->request->sort)) {
            return $this->failedLatestTransactions();
        } else {
            return $this->failedSortedTransactions();
        }
    }

    public function detail($id)
    {
        return UserCheckPayment::with('userExecutePayment', 'userTransaction', 'user')->where('id', $id)->firstOrFail();
    }

    public function getPayPointTransactionCount(){
        return UserCheckPayment::filter($this->request)->count();
    }

    public function getPayPointTransactionSum(){
        return UserTransaction::filter($this->request)->sum('amount') / 100;
    }
}
