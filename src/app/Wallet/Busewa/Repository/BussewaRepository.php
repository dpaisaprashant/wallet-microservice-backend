<?php


namespace App\Wallet\Bussewa\Repository;


use App\Models\BussewaTransaction;
use Illuminate\Http\Request;

class BussewaRepository
{
    private $request;

    private $length = 15;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param int $length
     * @return BussewaRepository
     */
    public function setLength(int $length): BussewaRepository
    {
        $this->length = $length;
        return $this;
    }

    public function sortedTransactions()
    {
        return Bussewa::with('user', 'transactionEvents', 'preTransaction')->latest()->filter($this->request)->paginate($this->length);
    }

    public function latestTransactions()
    {
        return Bussewa::with('user','transactions','preTransaction')->latest()->filter($this->request)->paginate($this->length);
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
        return Bussewa::with('user','transactionEvents')->where('id', $id)->firstOrFail();
    }

    public function getNepalQrTransactionCount(){
        return Bussewa::filter($this->request)->count();
    }

    public function getNepalQrTransactionSum(){
        return Bussewa::filter($this->request)->sum('amount');
    }
}
