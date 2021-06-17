<?php


namespace App\Wallet\Khalti\Repository;


use App\Models\KhaltiUserTransaction;
use App\Models\NchlAggregatedPayment;
use App\Models\NICAsiaCyberSourceLoadTransaction;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;

class KhaltiRepository
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
        return KhaltiUserTransaction::with('user', 'transactions')->latest()->filter(request())->paginate($this->length);
    }

    private function sortedTransactions()
    {
        return KhaltiUserTransaction::with('user', 'transactions')->filter(request())->paginate($this->length);
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
        return KhaltiUserTransaction::with('user', 'transactions', 'preTransaction')->where('id', $id)->firstOrFail();
    }

    public function getVendorName(){
        $vendorName = KhaltiUserTransaction::groupBy('vendor')->pluck('vendor');
        return $vendorName;
    }
}
