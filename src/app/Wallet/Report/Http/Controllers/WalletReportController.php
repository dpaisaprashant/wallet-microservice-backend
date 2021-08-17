<?php


namespace App\Wallet\Report\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Wallet\Report\Repositories\IndividualReconciliationReportRepositry;
use App\Wallet\Report\Repositories\NchlLoadReportRepository;
use App\Wallet\Report\Repositories\ReconciliationReportRepository;
use App\Wallet\Report\Traits\IndividualReconciliationReportGenerator;
use App\Wallet\Report\Traits\ReconciliationReportGenerator;
use Illuminate\Http\Request;

class WalletReportController extends Controller
{

    use ReconciliationReportGenerator;

    public function reconciliationReport(Request $request)
    {
        $repository = new ReconciliationReportRepository($request);

        $totalAmounts = $this->generateReport($repository);

        $totalLoadAmount = $repository->totalLoadAmount() / 100;
        $totalPaymentAmount = $repository->totalPaymentAmount() / 100;

        $totalWalletBalance = $repository->totalWalletBalanceAmount() / 100;
        $totalBonusBalance = $repository->totalBonusBalanceAmount() / 100;

        $mainBalance = $repository->totalMainBalanceAmount() / 100;

        return view('WalletReport::reconciliation.report')->with(compact('totalAmounts', 'totalLoadAmount', 'totalPaymentAmount','totalWalletBalance','totalBonusBalance','mainBalance'));
    }


    public function customerActivityReport(Request $request)
    {
        return view('WalletReport::customerActivity.report');
    }

    public function nchlLoadReport(Request $request)
    {
        $repository = new NchlLoadReportRepository($request);
        $services = $repository->generateServiceReport();

        return view('WalletReport::nchlLoad.report')->with(compact('services'));
    }
}
