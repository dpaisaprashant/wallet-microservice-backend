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

class ActiveInactiveTransactionRepository extends AbstractReportRepository
{
    protected $sixMonthBeforeFromDate;
    protected $twelveMonthBeforeFromDate;
    protected $from;
    protected $to;

    use CollectionPaginate;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->from = date('Y-m-d H:i:s', strtotime(str_replace(',', ' ', $request->transaction_from)));
        $this->to = date('Y-m-d', strtotime(str_replace(',', ' ', $request->transaction_to)));
        $this->sixMonthBeforeFromDate = Carbon::parse($this->from)->subMonths(6)->endOfDay()->toDateTimeString();
        $this->twelveMonthBeforeFromDate = Carbon::parse($this->from)->subMonths(12)->endOfDay()->toDateTimeString();
    }

    public function getUserCount($gender) {
        return User::where('gender', $gender)->filter($this->request)->count();
    }

    public function getUserTransactionCount($gender) {
       return TransactionEvent::whereHas("user", function ($query) use ($gender) {
           return $query->where("gender", $gender);
       })->count();
    }

    public function getUserTransactionValue($gender) {
        return TransactionEvent::whereHas("user", function ($query) use ($gender) {
            return $query->where("gender", $gender);
        })->sum('amount');
    }
}
