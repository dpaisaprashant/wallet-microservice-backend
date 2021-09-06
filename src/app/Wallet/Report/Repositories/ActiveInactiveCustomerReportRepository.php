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
        $this->from = date('Y-m-d', strtotime(str_replace(',', ' ', $request->select_date)));
        $this->to = date('Y-m-d', strtotime(str_replace(',', ' ', $request->to_transaction_event)));
        $this->sixMonthBeforeFromDate = Carbon::parse($this->from)->subMonths(6)->toDateString();
        $this->twelveMonthBeforeFromDate = Carbon::parse($this->from)->subMonths(12)->toDateString();
    }

    private function activeCustomerBuilder()
    {
//        return User::with('userTransactionEvents')->where(function ($q) {
//            return $q->whereHas('userTransactionEvents', function ($query) {
//                return $query->whereBetween('created_at', [$this->sixMonthBeforeFromDate, Carbon::parse($this->from)]);
//            })->orWhereBetween('phone_verified_at', [$this->sixMonthBeforeFromDate, Carbon::parse($this->from)]);
//        });
        $usersWithLatestTransaction = \DB::connection('dpaisa')->select("SELECT * FROM (SELECT transaction_events.* FROM (
        SELECT MAX(id) as id,user_id,MAX(created_at) AS created_at
                    FROM transaction_events GROUP BY user_id HAVING created_at <= '$this->from'
                ) AS latest_transaction
                 JOIN transaction_events ON transaction_events.id = latest_transaction.id
                WHERE latest_transaction.created_at BETWEEN '$this->sixMonthBeforeFromDate' AND '$this->from') as latest_transaction_in_timeperiod
                RIGHT JOIN users
                ON users.id = latest_transaction_in_timeperiod.user_id
                WHERE (((users.phone_verified_at BETWEEN '$this->sixMonthBeforeFromDate' AND '$this->from') AND latest_transaction_in_timeperiod.id IS NULL)
                OR (latest_transaction_in_timeperiod.id IS NOT NULL));");

        return $usersWithLatestTransaction;

    }

    private function inactiveFor6to12MonthsCustomerBuilder()
    {
        $usersWithLatestTransaction = \DB::connection('dpaisa')->select("SELECT * FROM (
            SELECT transaction_events.* FROM (
        SELECT MAX(id) as id,user_id,MAX(created_at) AS created_at
                    FROM transaction_events GROUP BY user_id HAVING created_at <= '$this->from'
        ) AS latest_transaction
        JOIN transaction_events ON transaction_events.id = latest_transaction.id
        WHERE latest_transaction.created_at BETWEEN '$this->sixMonthBeforeFromDate' AND '$this->from'
	) as latest_transaction_in_timeperiod
    RIGHT JOIN users
    ON users.id = latest_transaction_in_timeperiod.user_id
    WHERE (
        (
        (users.phone_verified_at BETWEEN '$this->sixMonthBeforeFromDate' AND '$this->from')
                AND
            NOT EXISTS(SELECT MAX(id) as id,user_id,MAX(created_at) AS created_at
                    FROM transaction_events GROUP BY user_id HAVING created_at <= '$this->from'
        ))
            OR (latest_transaction_in_timeperiod.id IS NOT NULL)
    	);");

        dd($usersWithLatestTransaction);

//
//        SELECT * FROM (
//            SELECT transaction_events.* FROM (
//        SELECT MAX(id) as id,user_id,MAX(created_at) AS created_at
//                    FROM transaction_events GROUP BY user_id HAVING created_at <= '2021-09-05'
//        ) AS latest_transaction
//        JOIN transaction_events ON transaction_events.id = latest_transaction.id
//        WHERE latest_transaction.created_at BETWEEN '2020-09-05' AND '2021-03-05'
//	) as latest_transaction_in_timeperiod
//    RIGHT JOIN users
//    ON users.id = latest_transaction_in_timeperiod.user_id
//    WHERE (
//        (
//        (users.phone_verified_at BETWEEN '2020-09-05' AND '2021-03-05')
//                AND (latest_transaction IS NULL)
//
//            )
//            OR (latest_transaction_in_timeperiod.id IS NOT NULL)
//    	);




//        SELECT * FROM (SELECT transaction_events.* FROM (
//        SELECT MAX(id) as id,user_id,MAX(created_at) AS created_at
//                    FROM transaction_events GROUP BY user_id HAVING created_at <= '2021-09-05'
//                ) AS latest_transaction
//                 JOIN transaction_events ON transaction_events.id = latest_transaction.id
//                WHERE latest_transaction.created_at BETWEEN '2020-09-05' AND '2021-03-05') as latest_transaction_in_timeperiod
//                RIGHT JOIN users
//                ON users.id = latest_transaction_in_timeperiod.user_id
//                WHERE (((users.phone_verified_at BETWEEN '2020-09-05' AND '2021-03-05')
//                            AND latest_transaction_in_timeperiod.id IS NULL )
//                OR (latest_transaction_in_timeperiod.id IS NOT NULL));







        $usersWithLatestTransaction = json_decode(json_encode($usersWithLatestTransaction), true);
        $usersWithLatestTransactionCom = json_decode(json_encode($this->activeCustomerBuilder()), true);
//        dd($usersWithLatestTransaction->array_diff($usersWithLatestTransactionCom,));
//        dd($usersWithLatestTransaction);
//        dd($usersWithLatestTransactionCom);
//        $flattenedUsersWithLatestTransaction=Arr::dot($usersWithLatestTransaction);
//        $flattened2=Arr::dot($usersWithLatestTransactionCom);
//dd($flattened1);
        $commonIDs = array();
        foreach ($usersWithLatestTransaction as $inactiveUser) {
            foreach ($usersWithLatestTransactionCom as $activeUser) {
                if ($activeUser['id'] == $inactiveUser['id']) {
                    $commonIDs[] = $inactiveUser;

                }
            }
        }
dd($commonIDs);

        foreach ($commonIDs as $commonID) {
            foreach ($usersWithLatestTransaction as $inactiveUser) {
                if($inactiveUser['id']!=$commonID['id']){

                }
            }

//        unset($usersWithLatestTransaction[$commonID]);

        }

        $flattenedCommonUsers=Arr::dot($inactiveUserArr,);
//        dd($flattenedUsersWithLatestTransaction);
//
//        $finalArray=array_diff($flattenedUsersWithLatestTransaction,$flattenedCommonUsers);
//        dd($finalArray);
////dd($commonIDs);



//        $result = $this->check_diff($usersWithLatestTransaction, $usersWithLatestTransactionCom);
//dd($result);

//        $diff=array_diff($flattened2,$flattened1);
//        dd($diff);

        $inactiveFor6to12MonthsUsers = array_reduce(array_flip($diff), function ($carry, $key) use ($diff) {
            Arr::set($carry, $key, $diff[$key]);
            return $carry;
        }, []);

        dd($inactiveFor6to12MonthsUsers);

        return $inactiveFor6to12MonthsUsers;
    }

    private function inactiveForMoreThan12MonthsCustomerBuilder()
    {

        $usersWithLatestTransaction = \DB::connection('dpaisa')->select("SELECT * FROM (SELECT transaction_events.* FROM (
        SELECT MAX(id) as id,user_id,MAX(created_at) AS created_at
                    FROM transaction_events GROUP BY user_id HAVING created_at <= '$this->from'
                ) AS latest_transaction
                 JOIN transaction_events ON transaction_events.id = latest_transaction.id
                WHERE latest_transaction.created_at <= '$this->twelveMonthBeforeFromDate') as latest_transaction_in_timeperiod
                RIGHT JOIN users
                ON users.id = latest_transaction_in_timeperiod.user_id
                WHERE (((users.phone_verified_at <= '$this->twelveMonthBeforeFromDate') AND (latest_transaction_in_timeperiod.id IS NULL))
                OR (latest_transaction_in_timeperiod.id IS NOT NULL));");
        dd($usersWithLatestTransaction);
//dd($this->inactiveFor6to12MonthsCustomerBuilder());
//dd($usersWithLatestTransaction);
        $usersWithLatestTransaction = Arr::dot(json_decode(json_encode($usersWithLatestTransaction), true));
        $usersWithLatestTransactionCom = Arr::dot(json_decode(json_encode($this->inactiveFor6to12MonthsCustomerBuilder()), true));
        $diff = array_diff($usersWithLatestTransaction, $usersWithLatestTransactionCom);

        $inactiveForMoreThan12MonthsUsers = array_reduce(array_flip($diff), function ($carry, $key) use ($diff) {
            Arr::set($carry, $key, $diff[$key]);
            return $carry;
        }, []);

        return $inactiveForMoreThan12MonthsUsers;
    }

    public function check_diff($arr1, $arr2)
    {
        $check = (is_array($arr1) && count($arr1) > 0) ? true : false;
        $result = ($check) ? ((is_array($arr2) && count($arr2) > 0) ? $arr2 : array()) : array();
        if ($check) {
            foreach ($arr1 as $key => $value) {
                if (isset($result[$key])) {
                    $result[$key] = array_diff($value, $result[$key]);
                } else {
                    $result[$key] = $value;
                }
            }
        }

        return $result;
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
        $total = 0;
        foreach ($this->activeCustomerBuilder() as $user) {
            if ($user->gender == 'm') {
                $total++;
            }
        }
        return $total;

//        return $this->activeCustomerBuilder()
//            ->where('gender', 'm')
//            ->get()
//            ->count();
    }

    public function activeMaleUserBalance()
    {
//        $users = $this->activeCustomerBuilder()
//            ->where('gender', 'm');

        $totalBalance = 0;
        foreach ($this->activeCustomerBuilder() as $user) {
            if ($user->gender == 'm') {
                $totalBalance += $user->balance + $user->bonus_balance;
            }
        }

//        $totalBalance = 0;
//        if (!empty($users) || count($users->get()) != 0) {
//            $latestUserTransactionEvents = $this->latestUserTransactionEvent($users);
//
//            foreach ($latestUserTransactionEvents as $latestUserTransactionEvent) {
//                if (!empty($latestUserTransactionEvent)) {
//                    $totalBalance += $latestUserTransactionEvent->userTransactionEvents[0]->balance + $latestUserTransactionEvent->userTransactionEvents[0]->bonus_balance;
//                }
//            }
//        }
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
//
//        return $this->activeCustomerBuilder()
//            ->where('gender', '=', 'f')
//            ->get()
//            ->count();
    }

    public function activeFemaleUserBalance()
    {
//        $users = $this->activeCustomerBuilder()
//            ->where('gender', 'f');

        $totalBalance = 0;
        foreach ($this->activeCustomerBuilder() as $user) {
            if ($user->gender == 'f') {
                $totalBalance += $user->balance + $user->bonus_balance;
            }
        }

//        $totalBalance = 0;
//        if (!empty($users) || count($users->get()) != 0) {
//            $latestUserTransactionEvents = $this->latestUserTransactionEvent($users);
//
//            foreach ($latestUserTransactionEvents as $latestUserTransactionEvent) {
//                if (!empty($latestUserTransactionEvent)) {
//                    $totalBalance += $latestUserTransactionEvent->userTransactionEvents[0]->balance + $latestUserTransactionEvent->userTransactionEvents[0]->bonus_balance;
//                }
//            }
//        }
        return $totalBalance;
    }

    public function activeOtherUserCount()
    {
//        return $this->activeCustomerBuilder()
//            ->where('gender', 'o')
//            ->get()
//            ->count();

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
//        $users = $this->activeCustomerBuilder()
//            ->where('gender', 'o');

        $totalBalance = 0;
        foreach ($this->activeCustomerBuilder() as $user) {
            if ($user->gender == 'o') {
                $totalBalance += $user->balance + $user->bonus_balance;
            }
        }
//
//        $totalBalance = 0;
//        if (!empty($users) || count($users->get()) != 0) {
//            $latestUserTransactionEvents = $this->latestUserTransactionEvent($users);
//            foreach ($latestUserTransactionEvents as $latestUserTransactionEvent) {
//                if (!empty($latestUserTransactionEvent)) {
//                    $totalBalance += $latestUserTransactionEvent->userTransactionEvents[0]->balance + $latestUserTransactionEvent->userTransactionEvents[0]->bonus_balance;
//                }
//            }
//        }

        return $totalBalance;
    }


    public function activeUnknownUserCount()
    {
//        return $this->activeCustomerBuilder()
//            ->where('gender', '=', null)
//            ->get()
//            ->count();

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
//        $users = $this->activeCustomerBuilder()
//            ->where('gender', '=', null);

        $totalBalance = 0;
        foreach ($this->activeCustomerBuilder() as $user) {
            if ($user->gender == null) {
                $totalBalance += $user->balance + $user->bonus_balance;
            }
        }

//        $totalBalance = 0;
//        if (!empty($users) || count($users->get()) != 0) {
//            $latestUserTransactionEvents = $this->latestUserTransactionEvent($users);
//
//            foreach ($latestUserTransactionEvents as $latestUserTransactionEvent) {
//                if (!empty($latestUserTransactionEvent)) {
//                    $totalBalance += $latestUserTransactionEvent->userTransactionEvents[0]->balance + $latestUserTransactionEvent->userTransactionEvents[0]->bonus_balance;
//                }
//            }
//        }

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
        dd($users);
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
