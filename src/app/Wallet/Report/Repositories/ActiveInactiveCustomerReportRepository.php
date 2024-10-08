<?php


namespace App\Wallet\Report\Repositories;


use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\UserKYC;
use App\Models\UserLoginHistory;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Filters\User\UserFilters;
use App\Traits\CollectionPaginate;
use Illuminate\Database\Eloquent\Builder;

class ActiveInactiveCustomerReportRepository extends AbstractReportRepository
{
    protected $sixMonthBeforeFromDate;
    protected $twelveMonthBeforeFromDate;
    protected $from;

    use CollectionPaginate;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->from = date('Y-m-d H:i:s', strtotime(str_replace(',', ' ', $request->select_date)));
        $this->to = date('Y-m-d', strtotime(str_replace(',', ' ', $request->to_transaction_event)));
        $this->sixMonthBeforeFromDate = Carbon::parse($this->from)->subMonths(6)->toDateTimeString();
        $this->twelveMonthBeforeFromDate = Carbon::parse($this->from)->subMonths(12)->toDateTimeString();
    }

    private function activeCustomerBuilder()
    {
        $endOfFrom=Carbon::parse($this->from)->endOfDay()->toDateTimeString();
//        $selectedDate= Carbon::parse($this->from)->endOfDay()->toDateString();
//        dd($selectedDate);
        $activeUsers = \DB::connection('dpaisa')->select("SELECT * FROM (
            SELECT transaction_events.id as latest_transaction_id,transaction_events.user_id,transaction_events.created_at as latest_transaction_date,transaction_events.balance,transaction_events.bonus_balance FROM (
        SELECT MAX(id) as latest_transaction_id,user_id,MAX(created_at) as latest_transaction_date from (SELECT * FROM transaction_events WHERE created_at <= '$endOfFrom') as transaction_in_range GROUP BY user_id
        ) AS latest_transaction
        JOIN transaction_events ON transaction_events.id = latest_transaction.latest_transaction_id
        WHERE latest_transaction.latest_transaction_date >= '$this->sixMonthBeforeFromDate' AND latest_transaction.latest_transaction_date <='$endOfFrom'
	) as latest_transaction_in_timeperiod
    RIGHT JOIN users
    ON users.id = latest_transaction_in_timeperiod.user_id
    WHERE (
        (
            (users.phone_verified_at >= '$this->sixMonthBeforeFromDate' AND users.phone_verified_at <= '$endOfFrom')
            AND
            NOT EXISTS(SELECT transaction_events.user_id,transaction_events.created_at
    FROM transaction_events WHERE users.id = transaction_events.user_id HAVING transaction_events.created_at <= '$endOfFrom'
        ))
            OR (latest_transaction_in_timeperiod.latest_transaction_id IS NOT NULL)
    	);");

        return $activeUsers;

    }

    private function inactiveFor6to12MonthsCustomerBuilder()
    {
        $endOfFrom=Carbon::parse($this->from)->endOfDay()->toDateTimeString();
        $endOfSixMonths=Carbon::parse($this->sixMonthBeforeFromDate)->endOfDay()->toDateTimeString();



        $inactiveFor6to12MonthsUsers = \DB::connection('dpaisa')->select("SELECT * FROM (
            SELECT transaction_events.id as latest_transaction_id,transaction_events.user_id,transaction_events.created_at as latest_transaction_date,transaction_events.balance,transaction_events.bonus_balance FROM (
        SELECT MAX(id) as latest_transaction_id,user_id,MAX(created_at) as latest_transaction_date from (SELECT * FROM transaction_events WHERE created_at <= '$endOfFrom') as transaction_in_range GROUP BY user_id
        ) AS latest_transaction
        JOIN transaction_events ON transaction_events.id = latest_transaction.latest_transaction_id
        WHERE latest_transaction.latest_transaction_date >= '$this->twelveMonthBeforeFromDate' AND latest_transaction.latest_transaction_date <='$endOfSixMonths'
	) as latest_transaction_in_timeperiod
    RIGHT JOIN users
    ON users.id = latest_transaction_in_timeperiod.user_id
    WHERE (
        (
            (users.phone_verified_at >= '$this->twelveMonthBeforeFromDate' AND users.phone_verified_at <= '$endOfSixMonths')
            AND
            NOT EXISTS(SELECT transaction_events.user_id,transaction_events.created_at
    FROM transaction_events WHERE users.id = transaction_events.user_id HAVING transaction_events.created_at <= '$endOfFrom'
        ))
            OR (latest_transaction_in_timeperiod.latest_transaction_id IS NOT NULL)
    	);");


        return $inactiveFor6to12MonthsUsers;
    }

    private function inactiveForMoreThan12MonthsCustomerBuilder()
    {
        $endOfFrom=Carbon::parse($this->from)->endOfDay()->toDateTimeString();
        $endOfTwelveMonths=Carbon::parse($this->twelveMonthBeforeFromDate)->endOfDay()->toDateTimeString();

        $inactiveForMoreThan12MonthsUsers = \DB::connection('dpaisa')->select("SELECT * FROM (
            SELECT transaction_events.id as latest_transaction_id,transaction_events.user_id,transaction_events.created_at as latest_transaction_date,transaction_events.balance,transaction_events.bonus_balance FROM (
        SELECT MAX(id) as latest_transaction_id,user_id,MAX(created_at) as latest_transaction_date from (SELECT * FROM transaction_events WHERE created_at <= '$endOfFrom') as transaction_in_range GROUP BY user_id
        ) AS latest_transaction
        JOIN transaction_events ON transaction_events.id = latest_transaction.latest_transaction_id
        WHERE latest_transaction.latest_transaction_date <='$endOfTwelveMonths'
	) as latest_transaction_in_timeperiod
    RIGHT JOIN users
    ON users.id = latest_transaction_in_timeperiod.user_id
    WHERE (
        (
            (users.phone_verified_at <= '$endOfTwelveMonths')
            AND
            NOT EXISTS(SELECT transaction_events.user_id,transaction_events.created_at
    FROM transaction_events WHERE users.id = transaction_events.user_id HAVING transaction_events.created_at <= '$endOfFrom'
        ))
            OR (latest_transaction_in_timeperiod.latest_transaction_id IS NOT NULL)
    	);");

        return $inactiveForMoreThan12MonthsUsers;
    }


    //ACTIVE
    public function activeMaleUserCount()
    {
        $total = 0;
        foreach ($this->activeCustomerBuilder() as $user) {
            if ($user->gender == 'm') {
                $total++;
            }
        }
        return $total;
    }

    public function activeMaleUserBalance()
    {
        $totalBalance = 0;
        foreach ($this->activeCustomerBuilder() as $user) {
            if ($user->gender == 'm') {
                $totalBalance += $user->balance + $user->bonus_balance;
            }
        }
        return $totalBalance;
    }

    public function activeFemaleUserCount()
    {
        $total = 0;
        foreach ($this->activeCustomerBuilder() as $user) {
            if ($user->gender == 'f') {
                $total++;
            }
        }
        return $total;

    }

    public function activeFemaleUserBalance()
    {
        $totalBalance = 0;
        foreach ($this->activeCustomerBuilder() as $user) {
            if ($user->gender == 'f') {
                $totalBalance += $user->balance + $user->bonus_balance;
            }
        }
        return $totalBalance;
    }

    public function activeOtherUserCount()
    {
        $total = 0;
        foreach ($this->activeCustomerBuilder() as $user) {
            if ($user->gender == 'o') {
                $total++;
            }
        }
        return $total;

    }

    public function activeOtherUserBalance()
    {

        $totalBalance = 0;
        foreach ($this->activeCustomerBuilder() as $user) {
            if ($user->gender == 'o') {
                $totalBalance += $user->balance + $user->bonus_balance;
            }
        }

        return $totalBalance;
    }


    public function activeUnknownUserCount()
    {

        $total = 0;
        foreach ($this->activeCustomerBuilder() as $user) {
            if ($user->gender == null) {
                $total++;
            }
        }
        return $total;


    }

    public function activeUnknownUserBalance()
    {

        $totalBalance = 0;
        foreach ($this->activeCustomerBuilder() as $user) {
            if ($user->gender == null) {
                $totalBalance += $user->balance + $user->bonus_balance;
            }
        }

        return $totalBalance;
    }

    public function activeTotalUserCount()
    {
        return $this->activeMaleUserCount() + $this->activeFemaleUserCount() + $this->activeOtherUserCount() + $this->activeUnknownUserCount();
    }

    public function activeTotalUserBalance()
    {
        return $this->activeMaleUserBalance() + $this->activeFemaleUserBalance() + $this->activeOtherUserBalance() + $this->activeUnknownUserBalance();
    }

    //INACTIVE 6 to 12 months
    public function inactiveFor6To12MonthsUserCount()
    {
        return count($this->inactiveFor6to12MonthsCustomerBuilder());
    }

    public function inactiveFor6To12MonthsUserBalance()
    {
        $users = $this->inactiveFor6To12MonthsCustomerBuilder();
        $totalBalance = 0;
        if (!empty($users)) {
            foreach ($users as $user) {
                $totalBalance += $user->balance + $user->bonus_balance;
            }
        }
        return $totalBalance;
    }


    //INACTIVE FOR MORE THAN 12 MONTHS
    public function inactiveForMoreThan12MonthsUserCount()
    {
        return count($this->inactiveForMoreThan12MonthsCustomerBuilder());
    }

    public function inactiveForMoreThan12MonthsUserBalance()
    {
        $users = $this->inactiveForMoreThan12MonthsCustomerBuilder();
        $totalBalance = 0;
//        $usersWithLatestTransaction


        if (!empty($users)) {
            foreach ($users as $user) {
                $totalBalance += $user->balance + $user->bonus_balance;
            }
        }

        return $totalBalance;
    }

    public function inactiveTotalUserCount()
    {
        return $this->inactiveFor6To12MonthsUserCount() + $this->inactiveForMoreThan12MonthsUserCount();
    }

    public function inactiveTotalUserBalance()
    {
        return $this->inactiveFor6To12MonthsUserBalance() + $this->inactiveForMoreThan12MonthsUserBalance();
    }
}
