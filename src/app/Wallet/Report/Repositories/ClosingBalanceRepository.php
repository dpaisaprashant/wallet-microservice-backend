<?php

namespace App\Wallet\Report\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClosingBalanceRepository extends AbstractReportRepository
{
    private string $date;
    private User $user;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->date = date('Y-m-d', strtotime(str_replace(',', ' ', $request->closing_date)));
        $this->user = User::whereMobileNo($request->mobile_no);
    }

    public function closingBalance()
    {

    }

    public function openingBalance()
    {

    }

    public function groupedTransactions(): array
    {
        return DB::connection("dpaisa")
            ->select("SELECT transaction_type, SUM(amount/100) AS total_amount
                                FROM transaction_events
                                WHERE date(created_at) == date($this->date)
                                AND user_id = $this->user->id
                                GROUP BY transaction_type
                                ");
    }

}
