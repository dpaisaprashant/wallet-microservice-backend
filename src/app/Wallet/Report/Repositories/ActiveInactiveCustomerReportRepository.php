<?php


namespace App\Wallet\Report\Repositories;


use App\Models\User;
use App\Models\UserKYC;
use App\Models\UserLoginHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActiveInactiveCustomerReportRepository extends AbstractReportRepository
{
    protected $sixMonthBeforeTodayDate;
    protected $twelveMonthBeforeTodayDate;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->sixMonthBeforeTodayDate = Carbon::now()->subMonths(6)->toDateString();
        $this->twelveMonthBeforeTodayDate = Carbon::now()->subMonths(12)->toDateString();
    }

    private function activeCustomerBuilder()
    {
        return User::with('latestLoginAttempt')->whereHas('latestLoginAttempt', function ($query) {
            return $query->whereDate('created_at', '>', $this->sixMonthBeforeTodayDate);
        });
    }

    private function inactiveFor6to12MonthsCustomerBuilder()
    {
        return User::with('latestLoginAttempt')->whereHas('latestLoginAttempt', function ($query) {
            return $query->whereBetween('created_at', [$this->twelveMonthBeforeTodayDate,$this->sixMonthBeforeTodayDate]);
        });

    }

    private function inactiveForMoreThan12MonthsCustomerBuilder()
    {
        return  User::whereHas('latestLoginAttempt', function ($query) {
            return $query->whereDate('created_at', '<=', $this->twelveMonthBeforeTodayDate);
        });
    }

    //ACTIVE
    public function activeMaleUserCount()
    {
        return $this->activeCustomerBuilder()
            ->filter($this->request)
            ->where('gender', 'm')
            ->count();
    }

    public function activeMaleUserBalance()
    {
        $users =  $this->activeCustomerBuilder()
            ->with('wallet')
            ->filter($this->request)
            ->where('gender','m')
//            ->whereHas('kyc', function ($query) {
//                return $query->where('gender', UserKYC::MALE);
//            })
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
            ->where('gender','f')
            ->count();
    }

    public function activeFemaleUserBalance()
    {
        $users =  $this->activeCustomerBuilder()
            ->with('wallet')
            ->filter($this->request)
            ->where('gender','f')
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
            ->where('gender','o')
            ->count();
        return $users;
    }

    public function activeOtherUserBalance()
    {
        $users =  $this->activeCustomerBuilder()
            ->with('wallet')
            ->filter($this->request)
            ->where('gender','o')
            ->get();

        $sum = 0;

        foreach ($users as $user){
            $sum += $user->wallet->balance;
        }
        return $sum;
    }


    public function activeUnknownUserCount()
    {
        return $userWithoutGender = $this->activeCustomerBuilder()
            ->with('wallet')
//            ->doesntHave('kyc')
            ->filter($this->request)
            ->where('gender', null)
            ->count();
    }

    public function activeUnknownUserBalance()
    {
        $userWithoutGender = $this->activeCustomerBuilder()
            ->with('wallet')
            ->filter($this->request)
            ->where('gender', null)
            ->get();

        $sum = 0;
        foreach ($userWithoutGender as $user){
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
        $test= $this->inactiveFor6To12MonthsCustomerBuilder()
            ->filter($this->request)
            ->get();
        dd($test);
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
