<?php


namespace App\Wallet\NCHL\Repository;


use App\Models\NchlBankTransfer;
use App\Models\UserCheckPayment;
use App\Models\UserLoadTransaction;
use App\Traits\CollectionPaginate;
use App\Wallet\PayPoint\Repository\PayPointRepository;
use Illuminate\Http\Request;

class NchlBankTransferRepository
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
        return NchlBankTransfer::with('user', 'transactions', 'commission')->latest()->filter($this->request)->paginate($this->length);
    }

    private function sortedTransactions()
    {
        return NchlBankTransfer::with('user', 'transactions', 'commission')->filter($this->request)->paginate($this->length);
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
        return NchlBankTransfer::with('user', 'transactions', 'commission')->where('id', $id)->firstOrFail();
    }

    public function getNchlLoadBankTransferTransactionCount(){
        return NchlBankTransfer::filter($this->request)->count();
    }

    public function getNchlLoadBankTransferTransactionSum(){
        return NchlBankTransfer::filter($this->request)->sum('amount') / 100;
    }

    public function latestTransactionsUnpaginated()
    {
        return NchlBankTransfer::with('preTransaction', 'transactions', 'commission')->latest()->filter($this->request);
    }
}
