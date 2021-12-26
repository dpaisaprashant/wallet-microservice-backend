<?php


namespace App\Wallet\Report\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Filters\User\UserFilters;
use App\Traits\CollectionPaginate;
use Illuminate\Database\Eloquent\Builder;

class ActiveInactiveUserReportRepository extends AbstractReportRepository
{
    protected $date;
    protected $fromAmount;
    protected $toAmount;

    use CollectionPaginate;

    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->date = date('Y-m-d', strtotime(str_replace(',', ' ', $request->from)));
        dd($this->date);
//        $this->fromAmount = $request->fromAmount;
//        $this->toAmount = $request->toAmount;
    }

    public function checkForReport(){
        return DB::connection('clearance')->table('nrb_active_inactive')->where('as_of_date', $this->date)->first();
    }

}
