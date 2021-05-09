<?php


namespace App\Wallet\NicAsia\Repository;


use App\Models\NchlAggregatedPayment;
use App\Models\NICAsiaCyberSourceLoadTransaction;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;

class NicAsiaCyberSourceRepository
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
        return NICAsiaCyberSourceLoadTransaction::with('user', 'transactions')->latest()->filter($this->request)->paginate($this->length);
    }

    private function sortedTransactions()
    {
        return NICAsiaCyberSourceLoadTransaction::with('user', 'transactions')->filter($this->request)->paginate($this->length);
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
        return NICAsiaCyberSourceLoadTransaction::with('user', 'transactions')->where('id', $id)->firstOrFail();
    }

    public function getAllCardLoadDetails(){
        return NICAsiaCyberSourceLoadTransaction::all();
    }
}
