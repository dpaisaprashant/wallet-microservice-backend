<?php


namespace App\Wallet\NPS\Repository;


use App\Models\NpsLoadTransaction;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class NPSRepository
{
    private $request;

    private  $length = 15;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param int $length
     * @return NPSRepository
     */
    public function setLength(int $length): NPSRepository
    {
        $this->length = $length;
        return $this;
    }

    private function sortedTransactions()
    {
        return NpsLoadTransaction::with('user', 'transactions', 'commission')->filter($this->request)->paginate($this->length);
    }

    private function latestTransactions()
    {
        return NpsLoadTransaction::with('user', 'transactions', 'commission')->filter($this->request)->latest()->paginate($this->length);
    }

    private function failedSortedTransactions()
    {
        return (new NpsLoadTransaction())->getFailedUserLoadTransaction()->filter($this->request)->paginate($this->length);
    }

    private function failedLatestTransactions()
    {
        return (new NpsLoadTransaction())->getFailedUserLoadTransaction()->filter($this->request)->latest()->paginate($this->length);
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
        return NpsLoadTransaction::with('user', 'transactions', 'commission')->where('id', $id)->firstOrFail();
    }


}
