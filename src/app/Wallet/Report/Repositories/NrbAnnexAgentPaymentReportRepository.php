<?php


namespace App\Wallet\Report\Repositories;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NrbAnnexAgentPaymentReportRepository extends AbstractReportRepository
{
    protected $fromDate;
    protected $fromAmount;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->fromDate = date('Y-m-d', strtotime(str_replace(',', ' ', $request->from)));
        $this->toDate = date('Y-m-d', strtotime(str_replace(',', ' ', $request->to)));
    }

    public function checkForReport()
    {
        return DB::connection('clearance')->table('agent_reports')->where('from_date', $this->fromDate)->where('to_date',$this->toDate)->first();
    }


}
