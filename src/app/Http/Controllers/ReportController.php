<?php

namespace App\Http\Controllers;

use App\Models\NchlBankTransfer;
use App\Models\TransactionEvent;
use App\Wallet\Commission\Models\Commission;
use App\Wallet\Report\Repositories\CommissionReportRepository;
use App\Wallet\Report\Repositories\WalletEndBalanceRepository;
use App\Wallet\TransactionEvent\Repository\NPayReportRepository;
use App\Wallet\TransactionEvent\Repository\PayPointReportRepository;
use App\Wallet\TransactionEvent\Repository\TransactionEventRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

use DB;

class ReportController extends Controller
{

    public function monthly(Request $request, TransactionEventRepository $repository)
    {
        $now = Carbon::now();
        $month = $now->format('m');
        $year = $now->format('Y');

        $transactions = $repository->paginatedMonthlyTransactions();

        return view('admin.report.monthly')->with(compact('year', 'month', 'transactions'));
    }

    public function yearly(Request $request, TransactionEventRepository $repository)
    {
        $transactions = $repository->paginatedYearlyTransactions();
        return view('admin.report.yearly')->with(compact('transactions'));
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

    public function walletEndBalance(WalletEndBalanceRepository $repository, Request $request)
    {
        $date = $request->get('till');
        $formatted_date = str_replace('T', ' ', $date);
        //dd($formatted_date);
        //$datas = $repository->getWalletEndBalance($date);
        //$totalSum = $repository->getTotalWalletEndBalanceAmount($date);

        $total = \DB::connection('dpaisa')->select(DB::raw("SELECT SUM(transaction_events.balance+transaction_events.bonus_balance) as total_wallet_balance
	FROM (
        SELECT user_id, MAX(created_at) as max_created_at, MAX(id) as max_id
			FROM transaction_events
        	WHERE Date(created_at) <= date('$formatted_date')
			GROUP BY user_id
    ) AS latest_transactions
    JOIN transaction_events
    	ON transaction_events.id = latest_transactions.max_id
	JOIN users
    	ON users.id = latest_transactions.user_id
  JOIN wallets
    	ON users.id = wallets.user_id"));

        //dd($totalSum[0]->total_wallet_balance);

        $totalSum = $total[0]->total_wallet_balance;
        $totalCount = "N/A";

        return view('admin.report.walletEndBalance', compact('totalSum'));
    }

    public function commissionReport(CommissionReportRepository $repository, Request $request)
    {
        //We get transactiontype from the form.
        //According to the transaction type we find out the transaction_id(Foreign key)
        //from the transaction_Events table.
        //transaction_id from the transaction events == id from the commission table
        //In commission table commissionable_id == id from the transaction events
        $selectedTransactionType = $request->get('transaction_type');


        $transactionsEvents = TransactionEvent::with('commission')->where('transaction_type', $selectedTransactionType)->filter(request())->get();

        $commissionId = $transactionsEvents->transform(function ($value) {
            if (optional($value->commission)->module == 'commission') {
                return optional($value->commission)->id;
            }
        })->filter();

        $transactionTotalAmount = TransactionEvent::whereIn('transaction_id', $commissionId)->where('transaction_type', Commission::class)->sum('amount');
        $transactionTotalCount = TransactionEvent::whereIn('transaction_id', $commissionId)->where('transaction_type', Commission::class)->count();
        return view('admin.report.commissionReport', compact('transactionTotalAmount', 'transactionTotalCount', 'selectedTransactionType'));
    }
}
