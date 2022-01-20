<?php


namespace App\Wallet\Report\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MiscReportRepository extends AbstractReportRepository
{
    protected $fromDate;
    protected $fromAmount;
    protected $toDate;
    protected $toAmount;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->fromDate = date('Y-m-d', strtotime(str_replace(',', ' ', $request->from)));
        $this->toDate = date('Y-m-d', strtotime(str_replace(',', ' ', $request->to)));

    }

    public function luckyWinner()
    {
        $luckyWinners = DB::connection('dpaisa')->select("SELECT t.pre_transaction_id, u.name, u.mobile_no, u.email, (t.amount/100) AS amount, t.created_at
                                                                        FROM transaction_events AS t
                                                                        JOIN users as u
                                                                        ON t.user_id = u.id
                                                                        WHERE t.transaction_type = 'App\\\\Models\\\\LoadTestFund'
                                                                        AND t.service_type LIKE 'LUCKY WINNER'
                                                                        AND date(t.created_at) >= date(:fromDate)
                                                                        AND date(t.created_at) <= date(:toDate);
                                                      ",['fromDate'=>$this->fromDate, 'toDate'=> $this->toDate]);

        return $luckyWinners;
    }

    public function ticketSale()
    {
        $ticketSales = DB::connection('dpaisa')->select("SELECT t.pre_transaction_id, u.name, u.mobile_no, u.email, (t.amount/100) AS amount, t.created_at
                                                                            FROM transaction_events AS t
                                                                            JOIN users as u
                                                                            ON t.user_id = u.id
                                                                            WHERE t.transaction_type = 'App\\\\Models\\\\TicketSale'
                                                                            AND date(t.created_at) >= date(:fromDate)
                                                                            AND date(t.created_at) <= date(:toDate);
                                                      ",['fromDate'=>$this->fromDate, 'toDate'=> $this->toDate]);

        return $ticketSales;
    }

}
