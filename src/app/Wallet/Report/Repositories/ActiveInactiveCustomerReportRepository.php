<?php


namespace App\Wallet\Report\Repositories;


use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\UserKYC;
use App\Models\UserLoginHistory;
use Carbon\Carbon;
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
        $this->from = date('Y-m-d', strtotime(str_replace(',', ' ', $request->select_date)));
        $this->to = date('Y-m-d', strtotime(str_replace(',', ' ', $request->to_transaction_event)));
        $this->sixMonthBeforeFromDate = Carbon::parse($this->from)->subMonths(6)->toDateString();
        $this->twelveMonthBeforeFromDate = Carbon::parse($this->from)->subMonths(12)->toDateString();
    }

    private function activeCustomerBuilder()
    {
        return User::with('userTransactionEvents')->where(function ($q) {
            return $q->whereHas('userTransactionEvents', function ($query) {
                return $query->whereBetween('created_at', [$this->sixMonthBeforeFromDate, Carbon::parse($this->from)]);
            })->orWhereBetween('phone_verified_at', [$this->sixMonthBeforeFromDate, Carbon::parse($this->from)]);
        });
    }

    private function inactiveFor6to12MonthsCustomerBuilder()
    {
        $usersWithLatestTransaction = \DB::connection('dpaisa')->select("SELECT * FROM (SELECT transaction_events.* FROM (
                    SELECT MAX(id) as id,user_id,MAX(created_at) AS created_at
                    FROM transaction_events GROUP BY user_id HAVING created_at <= '$this->from'
                ) AS latest_transaction
                 JOIN transaction_events ON transaction_events.id = latest_transaction.id
                WHERE latest_transaction.created_at BETWEEN '$this->twelveMonthBeforeFromDate' AND '$this->sixMonthBeforeFromDate') as latest_transaction_in_timeperiod
                INNER JOIN users
                ON users.id = latest_transaction_in_timeperiod.user_id;");


//        SELECT * FROM (SELECT transaction_events.* FROM (
//        SELECT MAX(id) as id,user_id,MAX(created_at) AS created_at
//                    FROM transaction_events GROUP BY user_id HAVING created_at <= '2021-09-03'
//                ) AS latest_transaction
//                 JOIN transaction_events ON transaction_events.id = latest_transaction.id
//                WHERE latest_transaction.created_at BETWEEN '2021-01-01' AND '2021-06-01') as latest_transaction_in_timeperiod
//                INNER JOIN users
//                ON users.id = latest_transaction_in_timeperiod.user_id;

//dd($this->sixMonthBeforeFromDate);
            return $usersWithLatestTransaction;
    }

    private function inactiveForMoreThan12MonthsCustomerBuilder()
    {
//        $activeUsers = $this->activeCustomerBuilder();
        //for comparing with active users

        $usersWithLatestTransaction = \DB::connection('dpaisa')->select("SELECT * FROM (SELECT transaction_events.* FROM (
                    SELECT MAX(id) as id,user_id,MAX(created_at) AS created_at
                    FROM transaction_events GROUP BY user_id HAVING created_at <= '$this->from'
                ) AS latest_transaction
                 JOIN transaction_events ON transaction_events.id = latest_transaction.id
                WHERE latest_transaction.created_at <= '$this->twelveMonthBeforeFromDate') as latest_transaction_in_timeperiod
                INNER JOIN users
                ON users.id = latest_transaction_in_timeperiod.user_id;");

        return $usersWithLatestTransaction;


//        if (!empty($activeUsers)) {
//
//            $users = User::with('userTransactionEvents')->where(function ($q) {
//                return $q->whereHas('userTransactionEvents', function ($query) {
//                    return $query->whereDate('created_at', '<=', $this->twelveMonthBeforeFromDate);
//                })->orWhereDate('phone_verified_at', '<=', $this->twelveMonthBeforeFromDate)
//                ->whereNotBetween('phone_verified_at',[$this->twelveMonthBeforeFromDate, Carbon::parse($this->from)]);
//            });
//
////            $inactiveUsers = $users->get()->diff($activeUsers);
////            return $inactiveUsers->diff($this->inactiveFor6to12MonthsCustomerBuilder());
//            return $users;
//        } else {
//            return User::with('userTransactionEvents')->where(function ($q) {
//                return $q->whereHas('userTransactionEvents', function ($query) {
//                    return $query->whereDate('created_at', '<=', $this->twelveMonthBeforeFromDate);
//                })->orWhereDate('phone_verified_at', '<=', $this->twelveMonthBeforeFromDate);
//            });
//        }
    }

    public function latestUserTransactionEvent($users)
    {
        $latestUserTransactionEvents = $users->with(['userTransactionEvents' => function ($query) {
            return $query->whereDate('created_at', '<=', Carbon::parse($this->from))->orderBy('created_at', 'desc');
        }])->whereHas('userTransactionEvents', function ($q) {
            return $q->whereDate('created_at', '<=', Carbon::parse($this->from));
        })->get();
        return $latestUserTransactionEvents;
    }

    //ACTIVE
    public function activeMaleUserCount()
    {
        return $this->activeCustomerBuilder()
            ->where('gender', 'm')
            ->get()
            ->count();
    }

    public function activeMaleUserBalance()
    {
        $users = $this->activeCustomerBuilder()
            ->where('gender', 'm');

        $totalBalance = 0;
        if (!empty($users) || count($users->get()) != 0) {
            $latestUserTransactionEvents = $this->latestUserTransactionEvent($users);

            foreach ($latestUserTransactionEvents as $latestUserTransactionEvent) {
                if (!empty($latestUserTransactionEvent)) {
                    $totalBalance += $latestUserTransactionEvent->userTransactionEvents[0]->balance + $latestUserTransactionEvent->userTransactionEvents[0]->bonus_balance;
                }
            }
        }
        return $totalBalance;
    }

    public function activeFemaleUserCount()
    {
        return $this->activeCustomerBuilder()
            ->where('gender', '=', 'f')
            ->get()
            ->count();
    }

    public function activeFemaleUserBalance()
    {
        $users = $this->activeCustomerBuilder()
            ->where('gender', 'f');

        $totalBalance = 0;
        if (!empty($users) || count($users->get()) != 0) {
            $latestUserTransactionEvents = $this->latestUserTransactionEvent($users);

            foreach ($latestUserTransactionEvents as $latestUserTransactionEvent) {
                if (!empty($latestUserTransactionEvent)) {
                    $totalBalance += $latestUserTransactionEvent->userTransactionEvents[0]->balance + $latestUserTransactionEvent->userTransactionEvents[0]->bonus_balance;
                }
            }
        }
        return $totalBalance;
    }

    public function activeOtherUserCount()
    {
        return $this->activeCustomerBuilder()
            ->where('gender', 'o')
            ->get()
            ->count();
    }

    public function activeOtherUserBalance()
    {
        $users = $this->activeCustomerBuilder()
            ->where('gender', 'o');

        $totalBalance = 0;
        if (!empty($users) || count($users->get()) != 0) {
            $latestUserTransactionEvents = $this->latestUserTransactionEvent($users);
            foreach ($latestUserTransactionEvents as $latestUserTransactionEvent) {
                if (!empty($latestUserTransactionEvent)) {
                    $totalBalance += $latestUserTransactionEvent->userTransactionEvents[0]->balance + $latestUserTransactionEvent->userTransactionEvents[0]->bonus_balance;
                }
            }
        }

        return $totalBalance;
    }


    public function activeUnknownUserCount()
    {
        return $this->activeCustomerBuilder()
            ->where('gender', '=', null)
            ->get()
            ->count();
    }

    public function activeUnknownUserBalance()
    {
        $users = $this->activeCustomerBuilder()
            ->where('gender', '=', null);

        $totalBalance = 0;
        if (!empty($users) || count($users->get()) != 0) {
            $latestUserTransactionEvents = $this->latestUserTransactionEvent($users);

            foreach ($latestUserTransactionEvents as $latestUserTransactionEvent) {
                if (!empty($latestUserTransactionEvent)) {
                    $totalBalance += $latestUserTransactionEvent->userTransactionEvents[0]->balance + $latestUserTransactionEvent->userTransactionEvents[0]->bonus_balance;
                }
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
