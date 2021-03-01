<?php

namespace App\Http\Controllers;

use App\Models\TransactionEvent;
use App\Wallet\TransactionEvent\Repository\NPayReportRepository;
use App\Wallet\TransactionEvent\Repository\PayPointReportRepository;
use App\Wallet\TransactionEvent\Repository\TransactionEventRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function monthly(Request $request, TransactionEventRepository $repository)
    {
        $now = Carbon::now();
        $month = $now->format('m');
        $year = $now->format('Y');

        $transactions = $repository->paginatedMonthlyTransactions();

        return view('admin.report.monthly')->with(compact('year','month', 'transactions'));
    }

    public function yearly(Request $request, TransactionEventRepository $repository)
    {
        $transactions = $repository->paginatedYearlyTransactions();
        return view('admin.report.yearly')->with(compact( 'transactions'));
    }

    public function paypoint(Request $request, PayPointReportRepository $repository)
    {
        $services = [];
        if (!empty($request->from) && !empty($request->to)) $services = $repository->generateServiceReport();
        return view('admin.report.paypoint')->with(compact('services'));
    }

    public function npay(Request $request, NPayReportRepository $repository)
    {
        $services = [];
        if (!empty($request->from) && !empty($request->to)) $services = $repository->generateServiceReport();
        return view('admin.report.npay')->with(compact('services'));
    }
}
