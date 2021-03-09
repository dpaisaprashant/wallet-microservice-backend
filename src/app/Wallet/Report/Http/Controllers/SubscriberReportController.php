<?php


namespace App\Wallet\Report\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Wallet\Report\Repositories\SubscriberReportRepository;
use App\Wallet\Report\Traits\SubscriberReportGenerator;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriberReportController extends Controller
{
    use SubscriberReportGenerator;

    public function subscriberDailyReport(Request $request)
    {
        $totalReportRepository = new SubscriberReportRepository($request);
        $totalReport = $this->generateReport($totalReportRepository);

        $todayFrom = Carbon::today()->startOfDay()->toDateTimeString();
        $todayTo = Carbon::today()->endOfDay()->toDateTimeString();
        $request->merge([
            'from' => $todayFrom,
            'to' => $todayTo
        ]);
        $todayReport = new SubscriberReportRepository($request);
        $dailyReport = $this->generateReport($todayReport);

        $report = [
            'Total' => $totalReport,
            'Daily' => $dailyReport
        ];

        return view('WalletReport::subscriber.report')->with(compact('report'));
    }
}
