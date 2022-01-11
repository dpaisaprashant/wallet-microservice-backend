<?php

namespace App\Wallet\TransactionClearance\Clearance\Repository;

use App\Models\TransactionEvent;
use App\Wallet\TransactionClearance\Clearance\contracts\ClearanceRepositoryContract;
use Illuminate\Http\Request;

class TransactionEventClearanceRepositoryContract implements ClearanceRepositoryContract
{
    private Request $request;

    public function __construct()
    {
        $this->request = request();
    }

    private int $length = 15;

    public function paginatedTransactions()
    {
        return TransactionEvent::with('transactionable', 'user', 'commission', 'commission.transactions')
            ->doesntHave('refundTransaction')
            ->latest()->filter($this->request)->paginate($this->length);
    }

    public function transactionsCount()
    {
        return TransactionEvent::doesntHave('refundTransaction')
            ->filter($this->request)->count();
    }

    public function transactionAmountSum()
    {
        return TransactionEvent::doesntHave('refundTransaction')
                ->filter($this->request)->sum('amount') / 100;
    }

    public function transactionFeeSum()
    {
        return TransactionEvent::doesntHave('refundTransaction')
            ->filter($this->request)
            ->get()
            ->sum('fee');
    }
}
