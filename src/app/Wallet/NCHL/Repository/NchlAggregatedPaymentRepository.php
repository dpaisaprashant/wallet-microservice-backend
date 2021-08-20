<?php


namespace App\Wallet\NCHL\Repository;


use App\Models\NchlAggregatedPayment;
use App\Models\NchlBankTransfer;
use App\Models\UserCheckPayment;
use App\Models\UserLoadTransaction;
use App\Traits\CollectionPaginate;
use App\Wallet\PayPoint\Repository\PayPointRepository;
use Illuminate\Http\Request;

class NchlAggregatedPaymentRepository
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
        return NchlAggregatedPayment::with('preTransaction', 'transactions', 'commission')->latest()->filter($this->request)->paginate($this->length);
    }

    private function sortedTransactions()
    {
        return NchlAggregatedPayment::with('preTransaction', 'transactions', 'commission')->filter($this->request)->paginate($this->length);
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
        return NchlAggregatedPayment::with('user', 'transactions', 'commission')->where('id', $id)->firstOrFail();
    }

    public function nchlAggregatePaymentTotalCount(){
        return NchlAggregatedPayment::filter(request())->count();
    }

    public function nchlAggregatePaymentTotalAmount(){
        return NchlAggregatedPayment::filter(request())->sum('amount') / 100;
    }
    public function nchlAggregatePaymentTotalFee(){
        return NchlAggregatedPayment::filter(request())->sum('transaction_fee') / 100;
    }

}
