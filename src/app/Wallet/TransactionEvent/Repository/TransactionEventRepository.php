<?php


namespace App\Wallet\TransactionEvent\Repository;


use App\Models\TransactionEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TransactionEventRepository
{

    private $request;

    private $length = 15;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param int $length
     * @return TransactionEventRepository
     */
    public function setLength(int $length): TransactionEventRepository
    {
        $this->length = $length;
        return $this;
    }


    public function sortedTransactions()
    {
        return TransactionEvent::with('transactionable', 'user', 'commission', 'commission.transactions')
            //->doesntHave('refundTransaction')
            ->whereNull("refund_id")
            ->filter($this->request)->paginate($this->length);
    }

    public function latestTransactions()
    {
        return TransactionEvent::with('transactionable', 'user', 'commission', 'commission.transactions')
            //->doesntHave('refundTransaction')
            ->whereNull("refund_id")
            ->latest()->filter($this->request)->paginate($this->length);
        //->filter($this->request)->paginate($this->length);
    }

    public function currentMonthTransactions()
    {
        $now = Carbon::now();
        $month = $now->format('m');
        $year = $now->format('Y');

        return TransactionEvent::whereMonth('created_at', '=', $month)
            ->with('transactionable')
            ->latest()
            ->filter($this->request)
            ->paginate($this->length);
    }

    public function currentYearTransactions()
    {
        $now = Carbon::now();
        $year = $now->format('Y');

        return TransactionEvent::whereYear('created_at', '=', $year)
            ->with('transactionable')
            ->latest()
            ->filter($this->request)
            ->paginate($this->length);
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

    public function transactionsCount()
    {
        return TransactionEvent::whereNull("refund_id")
            ->filter($this->request)->count();
    }

    public function transactionAmountSum()
    {
        return TransactionEvent::whereNull("refund_id")
                ->filter($this->request)->sum('amount') / 100;
    }

    public function transactionFeeSum()
    {
        return TransactionEvent::whereNull("refund_id")
                ->filter($this->request)
                ->get()
                ->sum('fee');
    }

    public function paginatedMonthlyTransactions()
    {
        if (empty($this->request->from || $this->request->to))
        {
            return $this->currentMonthTransactions();
        } else
        {
            return $this->latestTransactions();
        }
    }

    public function paginatedYearlyTransactions()
    {
        if (empty($this->request->from || $this->request->to))
        {
            return $this->currentYearTransactions();
        }else {
            return $this->latestTransactions();
        }
    }

    public function getUniqueVendors(){
        return Cache::remember('transactionVendors', 86400, function () {
            return  TransactionEvent::groupBy('vendor')->pluck('vendor');
        });
    }

    //For Individual User
    public function totalLoadedAmountUser()
    {
        return TransactionEvent::whereNull("refund_id")
            ->filter($this->request)->count();
    }

}
