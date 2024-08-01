<?php


namespace App\Wallet\NCHL\Repository;

use App\Models\NchlLoadTransaction;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;

class NchlLoadTransactionRepository
{
    use CollectionPaginate;

    private $request;

    private  $length = 15;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function setLength(int $length)
    {
        $this->length = $length;
        return $this;
    }

    private function latestTransactions()
    {
        return NchlLoadTransaction::with('user', 'transactions', 'commission')->latest()->filter($this->request)->paginate($this->length);
    }

    private function sortedTransactions()
    {
        return NchlLoadTransaction::with('user', 'transactions', 'commission')->filter($this->request)->paginate($this->length);
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

    public function detail($id)
    {
        return NchlLoadTransaction::with('user', 'transactions', 'commission')->where('id', $id)->firstOrFail();
    }

    public function getTotalNchlLoadTransactionCount(){
        return NchlLoadTransaction::filter($this->request)->count();
    }

    public function getTotalNchlLoadTransactionSum(){
        return NchlLoadTransaction::filter($this->request)->sum('amount') / 100;
    }

}
