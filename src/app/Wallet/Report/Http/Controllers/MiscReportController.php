<?php


namespace App\Wallet\Report\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Traits\CollectionPaginate;
use App\Wallet\Report\Repositories\MiscReportRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MiscReportController extends Controller
{
    use CollectionPaginate;

    public function luckyWinnerReport(Request $request)
    {
        $repository = new MiscReportRepository($request);

        $luckyWinners = $repository->luckyWinner();

        return view('WalletReport::luckyWinner.lucky-winner-report')->with(compact('luckyWinners'));
    }

    public function ticketSalesReport(Request $request)
    {
        $repository = new MiscReportRepository($request);

        $ticketSales = $repository->ticketSale();

        return view('WalletReport::ticketSale.ticket-sale-report')->with(compact('ticketSales'));
    }

}
