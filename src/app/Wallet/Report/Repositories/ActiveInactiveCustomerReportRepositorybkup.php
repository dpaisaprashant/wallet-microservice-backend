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
        $activeUsers = $this->activeCustomerBuilder();
        //for comparing with active users
        if (!empty($activeUsers)) {
            $users = User::with('userTransactionEvents')->where(function ($q) {
                return $q->whereHas('userTransactionEvents', function ($query) {
                    return $query->whereBetween('created_at', [$this->twelveMonthBeforeFromDate, $this->sixMonthBeforeFromDate]);
                })->orWhereBetween('phone_verified_at', [$this->twelveMonthBeforeFromDate, $this->sixMonthBeforeFromDate])
                ->whereNotBetween('phone_verified_at',[$this->sixMonthBeforeFromDate, Carbon::parse($this->from)]);
            });
//            return $users->get()->diff($activeUsers);
            return $users;
        } else {
            return User::with('userTransactionEvents')->where(function ($q) {
                return $q->whereHas('userTransactionEvents', function ($query) {
                    return $query->whereBetween('created_at', [$this->twelveMonthBeforeFromDate, $this->sixMonthBeforeFromDate]);
                })->orWhereBetween('phone_verified_at', [$this->twelveMonthBeforeFromDate, $this->sixMonthBeforeFromDate]);
            });
        }
    }

    private function inactiveForMoreThan12MonthsCustomerBuilder()
    {
        $activeUsers = $this->activeCustomerBuilder();
        //for comparing with active users
        if (!empty($activeUsers)) {
            $users = User::with('userTransactionEvents')->where(function ($q) {
                return $q->whereHas('userTransactionEvents', function ($query) {
                    return $query->whereDate('created_at', '<=', $this->twelveMonthBeforeFromDate);
                })->orWhereDate('phone_verified_at', '<=', $this->twelveMonthBeforeFromDate)
                ->whereNotBetween('phone_verified_at',[$this->twelveMonthBeforeFromDate, Carbon::parse($this->from)]);
            });

//            $inactiveUsers = $users->get()->diff($activeUsers);
//            return $inactiveUsers->diff($this->inactiveFor6to12MonthsCustomerBuilder());
            return $users;
        } else {
            return User::with('userTransactionEvents')->where(function ($q) {
                return $q->whereHas('userTransactionEvents', function ($query) {
                    return $query->whereDate('created_at', '<=', $this->twelveMonthBeforeFromDate);
                })->orWhereDate('phone_verified_at', '<=', $this->twelveMonthBeforeFromDate);
            });
        }
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
        return $this->inactiveFor6to12MonthsCustomerBuilder()
            ->count();
    }

    public function inactiveFor6To12MonthsUserBalance()
    {
        $users = $this->inactiveFor6To12MonthsCustomerBuilder();
        $totalBalance = 0;
        if (!empty($users)) {
            foreach ($users as $user) {
                $latestUserTransactionEvent = $user->userTransactionEvents->where('created_at', '<=', Carbon::parse($this->from))->sortBy('created_at', true);
                if (count($latestUserTransactionEvent)!= 0) {
                    $totalBalance += $latestUserTransactionEvent[0]->balance + $latestUserTransactionEvent[0]->bonus_balance;
                }
            }
        }
        return $totalBalance;
    }


    //INACTIVE FOR MORE THAN 12 MONTHS
    public function inactiveForMoreThan12MonthsUserCount()
    {
        return $this->inactiveForMoreThan12MonthsCustomerBuilder()
            ->count();
    }

    public function inactiveForMoreThan12MonthsUserBalance()
    {
        $users = $this->inactiveForMoreThan12MonthsCustomerBuilder();
        $totalBalance = 0;

        if (!empty($users)) {
            foreach ($users as $user) {
                $latestUserTransactionEvent = $user->userTransactionEvents->where('created_at', '<=', Carbon::parse($this->from))->sortBy('created_at', true);
                if (count($latestUserTransactionEvent)!= 0) {
                    $totalBalance += $latestUserTransactionEvent[0]->balance + $latestUserTransactionEvent[0]->bonus_balance;
                }
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
