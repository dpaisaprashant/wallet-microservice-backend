<?php


namespace App\Wallet\Report\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Traits\CollectionPaginate;

use App\Wallet\Report\Repositories\AbstractReportRepository;
use App\Wallet\Report\Repositories\AdminKycRepository;
use App\Wallet\Report\Repositories\ClosingBalanceRepository;
use Illuminate\Http\Request;

class ClosingBalanceController extends Controller
{
    use CollectionPaginate;

    public function getClosingBalanceReport(Request $request){

        $openingBalance = '';
        $closingBalance = '';
        $groupedTransactions = [];

        if(!empty($_GET)){
            $repository = new ClosingBalanceRepository($request);

            $openingBalance = '';
            $closingBalance = '';
            $groupedTransactions = $repository->groupedTransactions();
        }
        return view('WalletReport::closingBalance.report')
            ->with(compact('groupedTransactions', 'openingBalance', 'closingBalance'));
    }

}
