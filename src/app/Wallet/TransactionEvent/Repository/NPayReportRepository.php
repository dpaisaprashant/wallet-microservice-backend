<?php


namespace App\Wallet\TransactionEvent\Repository;


use App\Models\TransactionEvent;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use Illuminate\Http\Request;

class NPayReportRepository
{
    private $request;
    private $to;
    private $from;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->from = date('Y-m-d', strtotime(str_replace(',', ' ', $request->from)));
        $this->to = date('Y-m-d', strtotime(str_replace(',', ' ', $request->to)));
    }

    public function generateServiceReport()
    {
        return $transactions = TransactionEvent::with('transactionable')
            ->whereTransactionType(UserLoadTransaction::class)
            ->whereDate('created_at', '>=', $this->from)
            ->whereDate('created_at', '<=', $this->to)
            ->get()
            ->groupBy('vendor')
            ->transform(function ($value, $key) {
                $totalTransactionFee = 0;
                foreach ($value as $transaction) {
                    $totalTransactionFee += $transaction->transactionable->transaction_fee ?? 0;
                }
                return [
                    'service' => $key,
                    'count' => round(count($value), 0),
                    'amount' => round($value->sum('amount'), 2),
                    'transactionFee' => $totalTransactionFee,
                    'totalAmount' => round($value->sum('amount'), 2) - $totalTransactionFee
                ];
            });
    }
}
