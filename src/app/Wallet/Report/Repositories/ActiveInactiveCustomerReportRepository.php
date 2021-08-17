<?php


namespace App\Wallet\Report\Repositories;


use App\Models\User;
use App\Models\UserKYC;
use App\Models\UserLoginHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActiveInactiveCustomerReportRepository extends AbstractReportRepository
{
//    protected $sixMonthBeforeTodayDate;
//    protected $twelveMonthBeforeTodayDate;
    protected $sixMonthsBeforeFromDate;
    protected $twelveMonthsBeforeFromDate;

    public function __construct(Request $request)
    {
        parent::__construct($request);
//        if (!empty($_GET['from'])) {
//        $from_convert = strtotime($_GET['from']);
//        $from = date('Y-m-d', $from_convert);
//    }
//        if (!empty($_GET['to'])) {
//            $to_convert = strtotime($_GET['to']);
//            $to = date('Y-m-d', $to_convert);
//        }
//
//        $transactions = $repository->paginatedTransactions()->whereBetween('created_at', [Carbon::now()->subMonths(12)->format('Y-m-d'), Carbon::now()->format('Y-m-d')]);
//        if (!empty($_GET['from']) && !empty($_GET['to'])) {
//            $transactions = $repository->paginatedTransactions()->whereBetween('created_at', [$from, $to]);
//        }
//        dd(date($_GET['from'])->format('Y-m-d'));

        $from_convert = strtotime($_GET['from']);
        $from = date('Y-m-d', $from_convert);

        $this->sixMonthsBeforeFromDate = $from->subMonths(6)->toDateString();
        $this->twelveMonthsBeforeFromDate = $from->subMonths(12)->toDateString();
    }

    private function activeCustomerBuilder()
    {
        return User::with('latestLoginAttempt')->whereHas('latestLoginAttempt', function ($query) {
            return $query->whereDate('created_at', '>', $this->sixMonthsBeforeFromDate);
        });
    }

    private function inactiveFor6to12MonthsCustomerBuilder()
    {
        return User::with('latestUserTransactionEvent')->whereHas('latestUserTransactionEvent', function ($query) {
            return $query->whereDate('created_at', '<=', $this->sixMonthsBeforeFromDate)
                ->whereDate('created_at', '>', $this->twelveMonthsBeforeFromDate);
        });
    }

    private function inactiveForMoreThan12MonthsCustomerBuilder()
    {
        return  User::whereHas('latestLoginAttempt', function ($query) {
            return $query->whereDate('created_at', '<=', $this->twelveMonthsBeforeFromDate);
        });
    }

    //ACTIVE
    public function activeMaleUserCount()
    {
        return $this->activeCustomerBuilder()
            ->filter($this->request)
            ->whereHas('kyc', function ($query) {
                return $query->where('gender', UserKYC::MALE);
            })
            ->count();
    }

    public function activeMaleUserBalance()
    {
        $users =  $this->activeCustomerBuilder()
            ->with('wallet')
            ->filter($this->request)
            ->whereHas('kyc', function ($query) {
                return $query->where('gender', UserKYC::MALE);
            })
            ->get();
        $sum = 0;
        foreach ($users as $user){
            $sum += $user->wallet->balance;
        }
        return $sum;
    }

    public function activeFemaleUserCount()
    {
        return $this->activeCustomerBuilder()
            ->filter($this->request)
            ->whereHas('kyc', function ($query) {
                return $query->where('gender', UserKYC::FEMALE);
            })
            ->count();
    }

    public function activeFemaleUserBalance()
    {
        $users =  $this->activeCustomerBuilder()
            ->with('wallet')
            ->filter($this->request)
            ->whereHas('kyc', function ($query) {
                return $query->where('gender', UserKYC::FEMALE);
            })
            ->get();
        $sum = 0;
        foreach ($users as $user){
            $sum += $user->wallet->balance;
        }
        return $sum;
    }

    public function activeOtherUserCount()
    {
        $users =  $this->activeCustomerBuilder()
            ->with('wallet')
            ->filter($this->request)
            ->whereHas('kyc', function ($query) {
                return $query->where('gender', UserKYC::OTHER);
            })
            ->count();

        return $users;
    }

    public function activeOtherUserBalance()
    {
        $users =  $this->activeCustomerBuilder()
            ->with('wallet')
            ->filter($this->request)
            ->whereHas('kyc', function ($query) {
                return $query->where('gender', UserKYC::OTHER);
            })
            ->get();

        $sum = 0;

        foreach ($users as $user){
            $sum += $user->wallet->balance;
        }
        return $sum;
    }


    public function activeUnknownUserCount()
    {
        return $userWithoutKYC = $this->activeCustomerBuilder()
            ->with('wallet')
            ->doesntHave('kyc')
            ->filter($this->request)
            ->count();
    }

    public function activeUnknownUserBalance()
    {
        $userWithoutKYC = $this->activeCustomerBuilder()
            ->with('wallet')
            ->filter($this->request)
            ->doesntHave('kyc')
            ->get();

        $sum = 0;
        foreach ($userWithoutKYC as $user){
            $sum += $user->wallet->balance;
        }
        return $sum;
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
        return $this->inactiveFor6To12MonthsCustomerBuilder()
            ->filter($this->request)
            ->count();
    }

    public function inactiveFor6To12MonthsUserBalance()
    {
        $users =  $this->inactiveFor6To12MonthsCustomerBuilder()
            ->with('wallet')
            ->filter($this->request)
            ->get();
        $sum = 0;
        foreach ($users as $user){
            $sum += $user->wallet->balance;
        }
        return $sum;
    }


    //INACTIVE FOR MORE THAN 12 MONTHS
    public function inactiveForMoreThan12MonthsUserCount()
    {
        return $this->inactiveForMoreThan12MonthsCustomerBuilder()
            ->filter($this->request)
            ->count();
    }

    public function inactiveForMoreThan12MonthsUserBalance()
    {
        $users =  $this->inactiveForMoreThan12MonthsCustomerBuilder()
            ->with('wallet')
            ->filter($this->request)
            ->get();
        $sum = 0;
        foreach ($users as $user){
            $sum += $user->wallet->balance;
        }
        return $sum;
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
