<?php


namespace App\Wallet\Report\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Filters\User\UserFilters;
use App\Traits\CollectionPaginate;
use Illuminate\Database\Eloquent\Builder;

class NrbReconciliationReportRepository extends AbstractReportRepository
{
    protected $date;
    protected $fromAmount;
    protected $toAmount;

    use CollectionPaginate;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->from = date('Y-m-d', strtotime(str_replace(',', ' ', $request->from)));
        $this->to = date('Y-m-d', strtotime(str_replace(',', ' ', $request->to)));
        $this->npsAmount = $request->npsAmount;
        $this->nchlAmount = $request->nchlAmount;
        $this->statementAmount = $request->statementAmount;
        $this->npayAmount = $request->npayAmount;
        $this->cardSettledAmount = $request->cardSettledAmount;
    }

    public function checkForReport(){
        return DB::connection('clearance')->table('nrb_recon')->where('from_date', $this->from)->where('to_date', $this->to)->first();
    }

}
