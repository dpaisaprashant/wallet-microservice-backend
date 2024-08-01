<?php


namespace App\Wallet\Report\Repositories;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NrbEachAgentReportRepository extends AbstractReportRepository
{
    protected $fromDate;
    protected $toDate;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->fromDate = date('Y-m-d', strtotime(str_replace(',', ' ', $request->from_date)));
        $this->toDate = date('Y-m-d', strtotime(str_replace(',', ' ', $request->to_date)));
    }

    public function checkForReport()
    {
        return DB::connection('clearance')->table('nrb_agent_report_statuses')->where('from_date', $this->fromDate)->where('to_date',$this->toDate)->first();
    }


}
