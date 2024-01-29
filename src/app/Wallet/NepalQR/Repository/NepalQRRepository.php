<?php


namespace App\Wallet\NepalQR\Repository;


use App\Models\NepalQrTransaction;
use Illuminate\Http\Request;

class NepalQRRepository
{
    private $request;

    private $length = 15;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param int $length
     * @return NepalQRRepository
     */
    public function setLength(int $length): NepalQRRepository
    {
        $this->length = $length;
        return $this;
    }

    public function sortedTransactions()
    {
        return NepalQrTransaction::filter($this->request)->paginate($this->length);
    }

    public function latestTransactions()
    {
        return NepalQrTransaction::latest()->filter($this->request)->paginate($this->length);
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
        return NepalQrTransaction::with('fromUser', 'toUser', 'commission')->where('id', $id)->firstOrFail();
    }

    public function getNepalQrTransactionCount(){
        return NepalQrTransaction::filter($this->request)->count();
    }

    public function getNepalQrTransactionSum(){
        return NepalQrTransaction::filter($this->request)->sum('amount');
    }
}
