<?php


namespace App\Wallet\TransactionEvent\Repository;


use App\Models\TransactionEvent;
use App\Models\UserTransaction;
use Illuminate\Http\Request;

class PayPointReportRepository
{
    private $request;
    private $from;
    private $to;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->from = date('Y-m-d', strtotime(str_replace(',', ' ', $request->from)));
        $this->to = date('Y-m-d', strtotime(str_replace(',', ' ', $request->to)));
    }

    public function generateServiceReport()
    {
        return $transactions = TransactionEvent::with('transactionable')
            ->whereTransactionType(UserTransaction::class)
            ->whereDate('created_at', '>=', $this->from)
            ->whereDate('created_at', '<=', $this->to)
            ->get()
            ->groupBy('vendor')
            ->transform(function ($value, $key) {

                $totalRevenue = $value->sum(function($transactionEvent) {
                    return $transactionEvent->transactionable->excelTransaction->revenue ?? 0;
                });

                return [
                    'service' => $key,
                    'count' => round(count($value), 0),
                    'amount' => round($value->sum('amount'), 2),
                    'revenue' => $totalRevenue
                ];
            });
    }
}
