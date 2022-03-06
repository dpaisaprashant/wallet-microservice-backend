<?php


namespace App\Wallet\Report\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Wallet\Report\Repositories\NchlLoadReportRepository;
use App\Wallet\Report\Repositories\ReconciliationReportRepository;
use App\Wallet\Report\Traits\ReconciliationReportGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletReportController extends Controller
{

    use ReconciliationReportGenerator;

    public function dailyDashboard(Request $request)
    {
        $repository = new ReconciliationReportRepository($request);

        $totalAmounts = $this->generateReport($repository);

        $totalLoadAmount = $repository->totalLoadAmount() / 100;
        $totalPaymentAmount = $repository->totalPaymentAmount() / 100;

        return view('WalletReport::reconciliation.report-old')->with(compact('totalAmounts', 'totalLoadAmount', 'totalPaymentAmount'));
    }

    public function reconciliationReport(Request $request)
    {
        if (empty($_GET['date'])) {
            return view('WalletReport::reconciliation.report');
        }
        /* $repository = new ReconciliationReportRepository($request);

         $totalAmounts = $this->generateReport($repository);

         $totalLoadAmount = $repository->totalLoadAmount() / 100;
         $totalPaymentAmount = $repository->totalPaymentAmount() / 100;

         return view('WalletReport::reconciliation.report')->with(compact('totalAmounts', 'totalLoadAmount', 'totalPaymentAmount'));*/


        $date = $_GET['date'];
        $date = date('Y-m-d', strtotime(str_replace(',', ' ', $date)));

        $next_day =  date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $date) ) ));


        $ledger = DB::connection("dpaisa")->select(DB::connection("dpaisa")->raw("SELECT sum(amount/ 100) as total, transaction_type from transaction_events where date(created_at) = Date(:date) group by transaction_type"),
            array('date' => $date)
        );
        //dd($ledger);

        $paypoint_clearance_load = DB::connection("dpaisa")->select(DB::connection("dpaisa")->raw("SELECT SUM(after_amount/100-before_amount/100) as pp_load_total FROM `load_test_funds` WHERE `description` LIKE 'Paypoint Load' AND date(created_at) = Date(:date)"),
            array('date' => $date)
        );

        $cashback = DB::connection("dpaisa")->select(DB::connection("dpaisa")->raw("SELECT SUM(amount/100) as cashback_total  FROM `transaction_events` WHERE `service_type` LIKE 'CASHBACK' AND date(created_at) = date(:date)"),
            array('date' => $date)
        );
        $commission = DB::connection("dpaisa")->select(DB::connection("dpaisa")->raw("SELECT SUM(amount/100) as commission_total  FROM `transaction_events` WHERE `service_type` LIKE 'COMMISSION' AND date(created_at) = date(:date)"),
            array('date' => $date)
        );

        $lucky_winner = DB::connection("dpaisa")->select(DB::connection("dpaisa")->raw("SELECT SUM(amount/100) as lucky_winner_total  FROM `transaction_events` WHERE `service_type` LIKE 'LUCKY WINNER' AND date(created_at) = date(:date)"),
            array('date' => $date)
        );
        if($lucky_winner[0]->lucky_winner_total == null){
            $lucky_winner[0]->lucky_winner_total = 0;
        }
        //dd($lucky_winner[0]->lucky_winner_total);

        foreach ($ledger as $l){
            if($l->transaction_type == 'App\Models\LoadTestFund'){
                $l->transaction_type = 'Refunds/PaypointClearance/Test';
                $l->type = 'credit';
            }else if($l->transaction_type == 'App\Models\NchlBankTransfer'){
                $l->transaction_type = 'Bank Transfer';
                $l->type = 'debit';
            }else if($l->transaction_type == 'App\Models\NchlLoadTransaction'){
                $l->transaction_type = 'NHCL Load';
                $l->type = 'credit';
            }else if($l->transaction_type == 'App\Models\NpsLoadTransaction'){
                $l->transaction_type = 'NPS LOAD';
                $l->type = 'credit';
            }else if($l->transaction_type == 'App\Models\UserLoadTransaction'){
                $l->transaction_type = 'NPAY LOAD';
                $l->type = 'credit';
            }else if($l->transaction_type == 'App\Models\UserTransaction'){
                $l->transaction_type = 'Paypoint Payments';
                $l->type = 'debit';
            }else if($l->transaction_type == 'App\Wallet\Commission\Models\Commission'){
                $l->transaction_type = 'Commissions';
                $l->type = 'credit';
            }
        }
        //echo $ledger[0]->type;

        //dd($ledger[0]);

        $opening_balance = DB::connection("dpaisa")->select(DB::connection("dpaisa")->raw("SELECT SUM(transaction_events.bonus_balance/100+transaction_events.balance/100) as opening_balance FROM ( SELECT user_id, MAX(created_at) as max_created_at, MAX(id) as max_id FROM transaction_events WHERE Date(created_at) < Date(:date) GROUP BY user_id ) AS latest_transactions JOIN transaction_events ON transaction_events.id = latest_transactions.max_id JOIN users ON users.id = latest_transactions.user_id;"),
            array('date' => $date)
        );
        $closing_balance = DB::connection("dpaisa")->select(DB::connection("dpaisa")->raw("SELECT SUM(transaction_events.bonus_balance/100+transaction_events.balance/100) as closing_balance FROM ( SELECT user_id, MAX(created_at) as max_created_at, MAX(id) as max_id FROM transaction_events WHERE Date(created_at) < Date(:next_day) GROUP BY user_id ) AS latest_transactions JOIN transaction_events ON transaction_events.id = latest_transactions.max_id JOIN users ON users.id = latest_transactions.user_id;"),
            array('next_day' => $next_day)
        );

//        echo "OPENING BALANCE: ".$opening_balance[0]->opening_balance;
//        echo "<br/>";
//        echo "OPENING BALANCE: ".$closing_balance[0]->closing_balance;
//        echo "<br/>";
//        echo "Difference: ".$closing_balance[0]->closing_balance-$opening_balance[0]->opening_balance;
//        echo "<br/>";



        $data = [
            'ledger' => $ledger,
            'paypoint_load_clearance' => $paypoint_clearance_load[0]->pp_load_total,
            'cashback_total' => $cashback[0]->cashback_total,
            'commission_total' => $commission[0]->commission_total,
            'from_date' => $date,
            'opening_balance' => round($opening_balance[0]->opening_balance,2),
            'closing_balance' => round($closing_balance[0]->closing_balance,2),
            'lucky_winner' => $lucky_winner[0]->lucky_winner_total
        ];

        //dd($data);
        return view('WalletReport::reconciliation.report')->with(['data' => $data]);


    }

    public function reconciliationRangeReport(Request $request)
    {
        if (empty($_GET['from'])) {
            return view('WalletReport::reconciliation.report-range');
        }

        $date = $_GET['from'];
        $date = date('Y-m-d', strtotime(str_replace(',', ' ', $date)));
        $date_to = $_GET['to'];
        $date_to = date('Y-m-d', strtotime(str_replace(',', ' ', $date_to)));

        $next_day =  date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $date_to) ) ));



        $ledger = DB::connection('dpaisa')->select(DB::connection('dpaisa')->raw("SELECT sum(amount/ 100) as total, transaction_type from transaction_events where date(created_at) >= Date(:date) AND date(created_at) <= Date(:date_to) group by transaction_type"),
            array('date' => $date, 'date_to' => $date_to)
        );

        $paypoint_clearance_load = DB::connection('dpaisa')->select(DB::connection('dpaisa')->raw("SELECT SUM(after_amount/100-before_amount/100) as pp_load_total FROM `load_test_funds` WHERE `description` LIKE 'Paypoint Load' AND date(created_at) >= Date(:date) AND date(created_at) <= Date(:date_to)"),
            array('date' => $date, 'date_to' => $date_to)
        );

        $cashback = DB::connection('dpaisa')->select(DB::connection('dpaisa')->raw("SELECT SUM(amount/100) as cashback_total  FROM `transaction_events` WHERE `service_type` LIKE 'CASHBACK' AND date(created_at) >= Date(:date) AND date(created_at) <= Date(:date_to)"),
            array('date' => $date, 'date_to' => $date_to)
        );
        $commission = DB::connection('dpaisa')->select(DB::connection('dpaisa')->raw("SELECT SUM(amount/100) as commission_total  FROM `transaction_events` WHERE `service_type` LIKE 'COMMISSION' AND date(created_at) >= Date(:date) AND date(created_at) <= Date(:date_to)"),
            array('date' => $date, 'date_to' => $date_to)
        );

        $lucky_winner = DB::connection('dpaisa')->select(DB::connection('dpaisa')->raw("SELECT SUM(amount/100) as lucky_winner_total  FROM `transaction_events` WHERE `service_type` LIKE 'LUCKY WINNER' AND date(created_at) >= Date(:date) AND date(created_at) <= Date(:date_to)"),
            array('date' => $date, 'date_to' => $date_to)
        );
        if($lucky_winner[0]->lucky_winner_total == null){
            $lucky_winner[0]->lucky_winner_total = 0;
        }
        //dd($lucky_winner[0]->lucky_winner_total);

        foreach ($ledger as $l){
            if($l->transaction_type == 'App\Models\LoadTestFund'){
                $l->transaction_type = 'Refunds/PaypointClearance/Test';
                $l->type = 'credit';
            }else if($l->transaction_type == 'App\Models\NchlBankTransfer'){
                $l->transaction_type = 'Bank Transfer';
                $l->type = 'debit';
            }else if($l->transaction_type == 'App\Models\NchlLoadTransaction'){
                $l->transaction_type = 'NHCL Load';
                $l->type = 'credit';
            }else if($l->transaction_type == 'App\Models\NpsLoadTransaction'){
                $l->transaction_type = 'NPS LOAD';
                $l->type = 'credit';
            }else if($l->transaction_type == 'App\Models\UserLoadTransaction'){
                $l->transaction_type = 'NPAY LOAD';
                $l->type = 'credit';
            }else if($l->transaction_type == 'App\Models\UserTransaction'){
                $l->transaction_type = 'Paypoint Payments';
                $l->type = 'debit';
            }else if($l->transaction_type == 'App\Wallet\Commission\Models\Commission'){
                $l->transaction_type = 'Commissions';
                $l->type = 'credit';
            }
        }
        //echo $ledger[0]->type;

        $opening_balance = DB::connection('dpaisa')->select(DB::connection('dpaisa')->raw("SELECT SUM(transaction_events.bonus_balance/100+transaction_events.balance/100) as opening_balance FROM ( SELECT user_id, MAX(created_at) as max_created_at, MAX(id) as max_id FROM transaction_events WHERE Date(created_at) < Date(:date) GROUP BY user_id ) AS latest_transactions JOIN transaction_events ON transaction_events.id = latest_transactions.max_id JOIN users ON users.id = latest_transactions.user_id;"),
            array('date' => $date)
        );


        $closing_balance = DB::connection('dpaisa')->select(DB::connection('dpaisa')->raw("SELECT SUM(transaction_events.bonus_balance/100+transaction_events.balance/100) as closing_balance FROM ( SELECT user_id, MAX(created_at) as max_created_at, MAX(id) as max_id FROM transaction_events WHERE Date(created_at) < Date(:date) GROUP BY user_id ) AS latest_transactions JOIN transaction_events ON transaction_events.id = latest_transactions.max_id JOIN users ON users.id = latest_transactions.user_id;"),
            array('date' => $next_day)
        );
        //dd($closing_balance[0]);

//        echo "OPENING BALANCE: ".$opening_balance[0]->opening_balance;
//        echo "<br/>";
//        echo "OPENING BALANCE: ".$closing_balance[0]->closing_balance;
//        echo "<br/>";
//        echo "Difference: ".$closing_balance[0]->closing_balance-$opening_balance[0]->opening_balance;
//        echo "<br/>";



        $data = [
            'ledger' => $ledger,
            'paypoint_load_clearance' => $paypoint_clearance_load[0]->pp_load_total,
            'cashback_total' => $cashback[0]->cashback_total,
            'commission_total' => $commission[0]->commission_total,
            'from_date' => $date,
            'to_date' => $date_to,
            'opening_balance' => round($opening_balance[0]->opening_balance,2),
            'closing_balance' => round($closing_balance[0]->closing_balance,2),
            'lucky_winner' => $lucky_winner[0]->lucky_winner_total
        ];

        return view('WalletReport::reconciliation.report-range')->with(['data' => $data]);

//        dd($ledger);
//

//
//        $data = [
//            'ledger' => $ledger,
//            'opening_balance' => $opening_balance,
//            'closing_balance' => $closing_balance
//        ];
//        return view('reconciliation')->with(['data' => $data]);



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

    public function nrbReconciliationReport(Request $request)
    {
        $repository = new ReconciliationReportRepository($request);

        $totalAmounts = $this->generateReport($repository);

        $totalLoadAmount = $repository->totalLoadAmount() / 100;
        $totalPaymentAmount = $repository->totalPaymentAmount() / 100;

        return view('WalletReport::nrbReconciliation.report')->with(compact('totalAmounts', 'totalLoadAmount', 'totalPaymentAmount'));
    }

    public function walletLedger(Request $request){

        if (!isset($_GET['from_date']) || !isset($_GET['to_date'])) {
            return view('WalletReport::walletLedger.report');
        }

        $from_date = date('Y-m-d', strtotime(str_replace(',', ' ', $_GET['from_date'])));
        $to_date = date('Y-m-d', strtotime(str_replace(',', ' ', $_GET['to_date'])));

        $next_day =  date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $from_date) ) ));

        //$ledger = DB::connection('dpaisa')->select(DB::connection('dpaisa')->raw("SELECT sum(amount/ 100) as total, transaction_type from transaction_events where date(created_at) >= Date(:date) AND date(created_at) <= Date(:date_to) group by transaction_type"),

        $opening_balance = DB::connection('dpaisa')->select(DB::connection('dpaisa')->raw("SELECT SUM(transaction_events.bonus_balance/100+transaction_events.balance/100) as opening_balance FROM ( SELECT user_id, MAX(created_at) as max_created_at, MAX(id) as max_id FROM transaction_events WHERE Date(created_at) < Date(:date) GROUP BY user_id ) AS latest_transactions JOIN transaction_events ON transaction_events.id = latest_transactions.max_id JOIN users ON users.id = latest_transactions.user_id;"),
            array('date' => $from_date)
        );

        $closing_balance = DB::connection('dpaisa')->select(DB::connection('dpaisa')->raw("SELECT SUM(transaction_events.bonus_balance/100+transaction_events.balance/100) as closing_balance FROM ( SELECT user_id, MAX(created_at) as max_created_at, MAX(id) as max_id FROM transaction_events WHERE Date(created_at) < Date(:date) GROUP BY user_id ) AS latest_transactions JOIN transaction_events ON transaction_events.id = latest_transactions.max_id JOIN users ON users.id = latest_transactions.user_id;"),
            array('date' => $next_day)
        );

        $transactions = DB::connection('dpaisa')->select(DB::connection('dpaisa')->raw("SELECT * FROM `transaction_events` where date(created_at) >= date(:from_date) AND date(created_at) <= date(:to_date)"),
            array('from_date' => $from_date, 'to_date' => $to_date)
        );

        $data = [
            'opening_balance' => $opening_balance[0]->opening_balance,
            //'opening_balance' => "688966.03419999",
            'closing_balance' => $closing_balance[0]->closing_balance,
            //'closing_balance' => "683021.12419999",
            'transactions' => $transactions,
            'from_date' => $from_date,
            'to_date' => $to_date
        ];

        //dd($data);
        return view('WalletReport::walletLedger.report')->with(['data' => $data]);
    }
}
