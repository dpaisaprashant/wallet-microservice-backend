<?php


namespace App\Wallet\Report\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Filters\User\UserFilters;
use App\Traits\CollectionPaginate;
use Illuminate\Database\Eloquent\Builder;

class ActiveInactiveUserSlabReportRepository extends AbstractReportRepository
{
    protected $date;
    protected $fromAmount;
    protected $toAmount;

    use CollectionPaginate;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        if($request->all()!=null) {
            $this->date = date('Y-m-d', strtotime(str_replace(',', ' ', $request->from)));
            $this->fromAmount = $request->fromAmount * 100;
            $this->toAmount = $request->toAmount * 100;
        }
    }

    public function checkForReport(){
        return DB::connection('clearance')->table('active_inactive_slab')->where('as_of_date', $this->date)->where('slab_from', $this->fromAmount)->where('slab_to', $this->toAmount)->first();
    }

}
