<?php

namespace App\Wallet\Report\Repositories;

use App\Traits\CollectionPaginate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActiveInactiveUserReportRepository extends AbstractReportRepository
{
    protected $sixMonthBeforeFromDate;
    protected $twelveMonthBeforeFromDate;
    protected $oneDayBeforeFromDate;
    protected $from;


    use CollectionPaginate;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->from = date('Y-m-d H:i:s', strtotime(str_replace(',', ' ', $request->select_date)));
        $this->sixMonthBeforeFromDate = Carbon::parse($this->from)->subMonths(6)->toDateTimeString();
        $this->twelveMonthBeforeFromDate = Carbon::parse($this->from)->subMonths(12)->toDateTimeString();
        $this->oneDayBeforeFromDate = Carbon::parse($this->from)->subDays(1)->toDateTimeString();
    }


    public function activeUsersData()
    {
        $values = DB::connection('dpaisa')
            ->select("SELECT COUNT(*) as total_count,
       SUM(transaction_events.balance / 100) as total_balance,
       SUM(transaction_events.bonus_balance / 100) as total_bonus_balance
	        FROM (
                SELECT user_id, MAX(created_at) as max_created_at, MAX(id) as max_id
			    FROM transaction_events
        	    WHERE Date(created_at) BETWEEN '$this->sixMonthBeforeFromDate' AND '$this->from'
			    GROUP BY user_id
            ) AS latest_transactions
            JOIN transaction_events
            ON transaction_events.id = latest_transactions.max_id;");
        return (array) $values[0];
    }

    public function oneDayBeforeFromDateRegisteredUserCount()
    {
       $values =  DB::connection('dpaisa')
           ->select("SELECT COUNT(*) as count from users where Date(created_at) <= Date('$this->oneDayBeforeFromDate');");
       return (array) $values[0];
    }
}
