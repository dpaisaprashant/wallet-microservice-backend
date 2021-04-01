<?php


namespace App\Wallet\Report\Repositories;


use App\Models\NchlLoadTransaction;
use App\Models\TransactionEvent;
use Illuminate\Http\Request;

class NchlLoadReportRepository extends AbstractReportRepository
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function generateServiceReport()
    {
        return $transactions = TransactionEvent::with('transactionable')
            ->whereTransactionType(NchlLoadTransaction::class)
            ->filter($this->request)
            ->get()
            ->groupBy('vendor')
            ->transform(function ($value, $key) {

                $totalRevenue = 0;

                return [
                    'service' => $key,
                    'count' => round(count($value), 0),
                    'amount' => round($value->sum('amount'), 2),
                    'revenue' => $totalRevenue
                ];
            });
    }
}
