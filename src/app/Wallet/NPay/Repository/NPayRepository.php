<?php


namespace App\Wallet\NPay\Repository;


use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use Illuminate\Http\Request;

class NPayRepository
{
    private $request;

    private  $length = 15;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param int $length
     * @return NPayRepository
     */
    public function setLength(int $length): NPayRepository
    {
        $this->length = $length;
        return $this;
    }

    private function sortedTransactions()
    {
        return UserLoadTransaction::with('user', 'transactions', 'commission', 'loadTransactionResponse')->filter($this->request)->paginate($this->length);
    }

    private function latestTransactions()
    {
        return UserLoadTransaction::with('user', 'transactions', 'commission', 'loadTransactionResponse')->latest()->filter($this->request)->paginate($this->length);
    }

    private function failedSortedTransactions()
    {
        return (new UserLoadTransaction())->getFailedUserLoadTransaction()->filter($this->request)->paginate($this->length);
    }

    private function failedLatestTransactions()
    {
        return (new UserLoadTransaction())->getFailedUserLoadTransaction()->latest()->filter($this->request)->paginate($this->length);
    }


    public function paginatedTransactions()
    {
        if (empty($this->request->sort))
        {
            return $this->latestTransactions();
        } else
        {
            return $this->sortedTransactions();
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
        return UserLoadTransaction::with('user', 'transactions', 'loadTransactionResponse', 'commission')->where('id', $id)->firstOrFail();
    }
}
