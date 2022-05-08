<?php

namespace App\Wallet\Report\Http\Controllers;

use App\Models\Architecture\WalletTransactionType;
use App\Models\FundRequest;
use App\Models\NchlBankTransfer;
use App\Models\NchlLoadTransaction;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\UserKYC;
use App\Models\UserToUserFundTransfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyInfoReportController extends \App\Http\Controllers\Controller
{
    public function dailyInfoReport(Request $request)
    {
        $walletTransactionTypes = new WalletTransactionType();
        $bankTransferDetails = $walletTransactionTypes->getBankTransferTransactionModels();
        $bankLoadDetails = $walletTransactionTypes->getLoadTransactionModels();

        if (!$request->date) {
            return view('WalletReport::DailyInfo.daily_info_report');
        } else {

//        monthly sections starts Y-m-d

            $date = Carbon::parse(date('Y-m-d', strtotime(str_replace(',', ' ', $request->date))));


            $previous_month = $date->subMonth()->month;
            $date->addMonth();

            //getting the total number of registered users
            $total_users = User::count();

            //        getting total registered users in a month
            $total_monthly_users = User::whereMonth('created_at', $date->month)->count();

            //        getting total registered users in the previous month
            $previous_month_users = User::whereMonth('created_at', $previous_month)->count();

//                monthly section ends

//        daily section starts

//        getting users registered on the particular day
            $total_registered_on_given_date = User::whereDate('created_at', '=', $date->toDateString())->count();

//        getting users registered on the previous day
            $previous_day = $date->subDay()->toDateString();
            $date->addDay();

            $total_registered_on_previous_day = User::whereDate('created_at', '=', $previous_day)->count();
            $registered_users_day_change = $this->changeCalculator($total_registered_on_given_date, $total_registered_on_previous_day);
            $registered_users_day_changes = $this->changeStatus($registered_users_day_change);
            $registered_users_day_change = $registered_users_day_changes['change'];
            $registered_users_change_status = $registered_users_day_changes['status'];

//        daily section ends


//        kyc section starts
            $requested_kycs = UserKYC::whereDate('created_at', '=', $date->toDateString())->get('accept');
            $kyc_details = $this->calculateKycDetails($requested_kycs);
            $kyc_count = $kyc_details['kyc_count'];
            $accepted_kyc = $kyc_details['accepted_kyc'];
            $rejected_kyc = $kyc_details['rejected_kyc'];
            $pending_kyc = $kyc_details['pending_kyc'];

//        previous day kyc starts
            $previous_requested_kycs = UserKYC::whereDate('created_at', '=', $previous_day)->get('accept');
            $previous_kyc_details = $this->calculateKycDetails($previous_requested_kycs);
            $previous_kyc_count = $previous_kyc_details['kyc_count'];
            $previous_accepted_kyc = $previous_kyc_details['accepted_kyc'];
            $previous_rejected_kyc = $previous_kyc_details['rejected_kyc'];
            $previous_pending_kyc = $previous_kyc_details['pending_kyc'];
//        previous day kyc ends

//        calculating change for kyc starts

            $kyc_count_change = $this->changeCalculator($kyc_count, $previous_kyc_count);
            $accepted_kyc_change = $this->changeCalculator($accepted_kyc, $previous_accepted_kyc);
            $rejected_kyc_change = $this->changeCalculator($rejected_kyc, $previous_rejected_kyc);
            $pending_kyc_change = $this->changeCalculator($pending_kyc, $previous_pending_kyc);

            $kyc_count_changes = $this->changeStatus($kyc_count_change);
            $kyc_count_change = $kyc_count_changes['change'];
            $kyc_count_change_status = $kyc_count_changes['status'];

            $accepted_kyc_changes = $this->changeStatus($accepted_kyc_change);
            $accepted_kyc_change = $accepted_kyc_changes['change'];
            $accepted_kyc_change_status = $accepted_kyc_changes['status'];

            $rejected_kyc_changes = $this->changeStatus($rejected_kyc_change);
            $rejected_kyc_change = $rejected_kyc_changes['change'];
            $rejected_kyc_change_status = $rejected_kyc_changes['status'];

            $pending_kyc_changes = $this->changeStatus($pending_kyc_change);
            $pending_kyc_change = $pending_kyc_changes['change'];
            $pending_kyc_change_status = $pending_kyc_changes['status'];

//        calculating change for kyc ends


//        kyc section ends

//        user Transaction Section Starts

            $user_transaction_details = $this->getUserTransactionDetails($date->toDateString());
            $user_total_transaction = $user_transaction_details['total_transaction'] / 100;
            $user_total_transaction_count = $user_transaction_details['total_count'];

//        previous day transaction sections starts
            $user_previous_transaction_details = $this->getUserTransactionDetails($previous_day);
            $user_previous_total_transaction = $user_previous_transaction_details['total_transaction'] / 100;
            $user_previous_total_transaction_count = $user_previous_transaction_details['total_count'];

            $user_transaction_change = $this->changeCalculator($user_total_transaction, $user_previous_total_transaction);
            $user_transaction_count_change = $this->changeCalculator($user_total_transaction_count, $user_previous_total_transaction_count);

            // calculating user transaction total transaction change
            $user_transaction_change_details = $this->changeStatus($user_transaction_change);
            $user_transaction_change = $user_transaction_change_details['change'];
            $user_transaction_change_status = $user_transaction_change_details['status'];

            // calculating user transaction total transaction count change
            $user_transaction_count_change_details = $this->changeStatus($user_transaction_count_change);
            $user_transaction_count_change = $user_transaction_count_change_details['change'];
            $user_transaction_count_change_status = $user_transaction_count_change_details['status'];

//        previous day transaction sections ends
//        User Transaction Section Ends

//        Agent Transaction Section Starts

            $agent_transaction_details = $this->getAgentTransactionDetails($date->toDateString());
            $agent_total_transaction = $agent_transaction_details['total_transaction'] / 100;
            $agent_total_transaction_count = $agent_transaction_details['total_count'];

//        agent previous day transaction details
            $agent_previous_transaction_details = $this->getAgentTransactionDetails($previous_day);
            $agent_previous_total_transaction = $agent_previous_transaction_details['total_transaction'] / 100;
            $agent_previous_total_transaction_count = $agent_previous_transaction_details['total_count'];
//        agent previous day transaction details ends

            $agent_transaction_change = $this->changeCalculator($agent_total_transaction, $agent_previous_total_transaction);
            $agent_transaction_count_change = $this->changeCalculator($agent_total_transaction_count, $agent_previous_total_transaction_count);

            // calculating agent transaction total transaction change
            $agent_transaction_change_details = $this->changeStatus($agent_transaction_change);
            $agent_transaction_change = $agent_transaction_change_details['change'];
            $agent_transaction_change_status = $agent_transaction_change_details['status'];

            // calculating agent transaction total transaction count change
            $agent_transaction_count_change_details = $this->changeStatus($agent_transaction_count_change);
            $agent_transaction_count_change = $agent_transaction_count_change_details['change'];
            $agent_transaction_count_change_status = $agent_transaction_count_change_details['status'];

//        Agent Transaction Sections Ends

//        Total Transaction details Section Starts
            $total_transaction_details = $this->getTotalTransactionDetails($date->toDateString());
            $total_total_transaction = $total_transaction_details['total_transaction'] / 100;
            $total_total_transaction_count = $total_transaction_details['total_count'];

//        total previous day transaction details
            $total_previous_transaction_details = $this->getTotalTransactionDetails($previous_day);
            $total_previous_total_transaction = $total_previous_transaction_details['total_transaction'] / 100;
            $total_previous_total_transaction_count = $total_previous_transaction_details['total_count'];
//        total previous day transaction details ends

            $total_transaction_change = $this->changeCalculator($total_total_transaction, $total_previous_total_transaction);
            $total_transaction_count_change = $this->changeCalculator($total_total_transaction_count, $total_previous_total_transaction_count);

            // calculating total transaction change
            $total_transaction_change_details = $this->changeStatus($total_transaction_change);
            $total_transaction_change = $total_transaction_change_details['change'];
            $total_transaction_change_status = $total_transaction_change_details['status'];

            // calculating total transaction count change
            $total_transaction_count_change_details = $this->changeStatus($total_transaction_count_change);
            $total_transaction_count_change = $total_transaction_count_change_details['change'];
            $total_transaction_count_change_status = $total_transaction_count_change_details['status'];

//        Total Transaction details Section ends

//        Bank Load Details Calculation

            $bankLoadDetails = $this->getBankLoadDetails($date->toDateString(),$bankLoadDetails);
            $bankLoadAmount = $bankLoadDetails['amount'] / 100;
            $bankLoadCount = $bankLoadDetails['count'];

            $previousDayBankLoadDetails = $this->getBankLoadDetails($previous_day,$bankLoadDetails);
            $previousDayBankLoadAmount = $previousDayBankLoadDetails['amount'] / 100;
            $previousDayBankLoadCount = $previousDayBankLoadDetails['count'];

            // calculating bank load amount/count change
            $bankLoadChange = $this->changeCalculator($bankLoadAmount, $previousDayBankLoadAmount);
            $bankLoadCountChange = $this->changeCalculator($bankLoadCount, $previousDayBankLoadCount);

//        getting status of bank load amount/count change
            $bankLoadChangeDetails = $this->changeStatus($bankLoadChange);
            $bankLoadChange = $bankLoadChangeDetails['change'];
            $bankLoadChangeStatus = $bankLoadChangeDetails['status'];

            $bankLoadCountChangeDetails = $this->changeStatus($bankLoadCountChange);
            $bankLoadCountChange = $bankLoadCountChangeDetails['change'];
            $bankLoadCountChangeStatus = $bankLoadCountChangeDetails['status'];

//        Bank load Details section ends

//        Bank Transfer Details Section Starts

            $bankTransferDetails = $this->getBankTransferDetails($date->toDateString(),$bankTransferDetails);
            $bankTransferAmount = $bankTransferDetails['amount'] / 100;
            $bankTransferCount = $bankTransferDetails['count'];

//        previous day bank Transfer Details
            $previousBankTransferDetails = $this->getBankTransferDetails($previous_day,$bankTransferDetails);
            $previousBankTransferAmount = $previousBankTransferDetails['amount'] / 100;
            $previousBankTransferCount = $previousBankTransferDetails['count'];

            // calculating bank transfer amount/count change
            $bankTransferAmountChange = $this->changeCalculator($bankTransferAmount, $previousBankTransferAmount);
            $bankTransferCountChange = $this->changeCalculator($bankTransferCount, $previousBankTransferCount);

            // getting status of the bankTransfer amount/count change
            $bankTransferAmountChangeDetails = $this->changeStatus($bankTransferAmountChange);
            $bankTransferAmountChange = $bankTransferAmountChangeDetails['change'];
            $bankTransferAmountChangeStatus = $bankTransferAmountChangeDetails['status'];

            $bankTransferCountChangeDetails = $this->changeStatus($bankTransferCountChange);
            $bankTransferCountChange = $bankTransferCountChangeDetails['change'];
            $bankTransferCountChangeStatus = $bankTransferCountChangeDetails['status'];

//        Bank Transfer Details Section Ends

//        P2P section starts
            $userToUserFundTransferDetails = $this->userToUserTransferDetails($date->toDateString());
            $userToUserFundTransferAmount = $userToUserFundTransferDetails['amount'] / 100;
            $userToUserFundTransferCount = $userToUserFundTransferDetails['count'];

            // previous day P2P
            $userToUserPreviousFundTransferDetails = $this->userToUserTransferDetails($previous_day);
            $userToUserPreviousFundTransferAmount = $userToUserPreviousFundTransferDetails['amount'] / 100;
            $userToUserPreviousFundTransferCount = $userToUserPreviousFundTransferDetails['count'];

            // calculating change for P2P count/amount
            $userToUserFundTransferAmountChange = $this->changeCalculator($userToUserFundTransferAmount, $userToUserPreviousFundTransferAmount);
            $userToUserFundTransferCountChange = $this->changeCalculator($userToUserFundTransferCount, $userToUserPreviousFundTransferCount);

            // calculating change status for P2P count/amount
            $userToUserFundTransferAmountChangeDetails = $this->changeStatus($userToUserFundTransferAmountChange);
            $userToUserFundTransferAmountChange = $userToUserFundTransferAmountChangeDetails['change'];
            $userToUserFundTransferAmountChangeStatus = $userToUserFundTransferAmountChangeDetails['status'];

            $userToUserFundTransferCountChangeDetails = $this->changeStatus($userToUserFundTransferCountChange);
            $userToUserFundTransferCountChange = $userToUserFundTransferCountChangeDetails['change'];
            $userToUserFundTransferCountChangeStatus = $userToUserFundTransferCountChangeDetails['status'];

//        P2P section ends


            $reports = [
                [
                    'heading' => "Total User Registered in " . $date->monthName,
                    'particulars' => "",
                    'total_number' => $total_users,
                    'data' => $total_monthly_users,
                    'previous_day_report' => $previous_month_users,
                    'change' => "",
                ],
                [
                    'heading' => "User Registered in " . $date->toDateString(),
                    'particulars' => "",
                    'total_number' => "",
                    'data' => $total_registered_on_given_date,
                    'previous_day_report' => $total_registered_on_previous_day,
                    'change' => ['change_value' => $registered_users_day_change, 'status' => $registered_users_change_status],
                ],
                [
                    'heading' => "KYC",

                    'particulars' => ["KYC Requested", "KYC Accepted", "KYC Rejected", "Total Pending KYC"],
                    'total_number' => "",
                    'data' => [
                        $kyc_count,
                        $accepted_kyc,
                        $rejected_kyc,
                        $pending_kyc
                    ],
                    'previous_day_report' => [
                        $previous_kyc_count,
                        $previous_accepted_kyc,
                        $previous_rejected_kyc,
                        $previous_pending_kyc
                    ],
                    'change' => [
                        ['change_value' => $kyc_count_change, 'status' => $kyc_count_change_status],
                        ['change_value' => $accepted_kyc_change, 'status' => $accepted_kyc_change_status],
                        ['change_value' => $rejected_kyc_change, 'status' => $rejected_kyc_change_status],
                        ['change_value' => $pending_kyc_change, 'status' => $pending_kyc_change_status]
                    ],
                ],
                [
                    'heading' => "User's Transaction",
                    'particulars' => ["Total Transaction (Rs.)", "Total Count"],
                    'total_number' => "",
                    'data' => [$user_total_transaction, $user_total_transaction_count],
                    'previous_day_report' => [$user_previous_total_transaction, $user_previous_total_transaction_count],
                    'change' => [
                        ['change_value' => $user_transaction_change, 'status' => $user_transaction_change_status],
                        ['change_value' => $user_transaction_count_change, 'status' => $user_transaction_count_change_status],
                    ],
                ],
                [
                    'heading' => "Agent's Transaction",
                    'particulars' => ["Total Transaction (Rs.)", "Total Count"],
                    'total_number' => "",
                    'data' => [$agent_total_transaction, $agent_total_transaction_count],
                    'previous_day_report' => [$agent_previous_total_transaction, $agent_previous_total_transaction_count],
                    'change' => [
                        ['change_value' => $agent_transaction_change, 'status' => $agent_transaction_change_status],
                        ['change_value' => $agent_transaction_count_change, 'status' => $agent_transaction_count_change_status],
                    ],
                ],
                [
                    'heading' => "Total Transaction",
                    'particulars' => ["Total Transaction (Rs.)", "Total Count"],
                    'total_number' => "",
                    'data' => [$total_total_transaction, $total_total_transaction_count],
                    'previous_day_report' => [$total_previous_total_transaction, $total_previous_total_transaction_count],
                    'change' => [
                        ['change_value' => $total_transaction_change, 'status' => $total_transaction_change_status],
                        ['change_value' => $total_transaction_count_change, 'status' => $total_transaction_count_change_status],
                    ],
                ],
                [
                    'heading' => "Bank Load",
                    'particulars' => ["Total Load (Rs.)", "Total Count"],
                    'total_number' => "",
                    'data' => [$bankLoadAmount, $bankLoadCount],
                    'previous_day_report' => [$previousDayBankLoadAmount, $previousDayBankLoadCount],
                    'change' => [
                        ['change_value' => $bankLoadChange, 'status' => $bankLoadChangeStatus],
                        ['change_value' => $bankLoadCountChange, 'status' => $bankLoadCountChangeStatus],
                    ],
                ],
                [
                    'heading' => "Bank Transfer",
                    'particulars' => ["Amount (Rs.)", "Count"],
                    'total_number' => "",
                    'data' => [$bankTransferAmount, $bankTransferCount],
                    'previous_day_report' => [$previousBankTransferAmount, $previousBankTransferAmount],
                    'change' => [
                        ['change_value' => $bankTransferAmountChange, 'status' => $bankTransferAmountChangeStatus],
                        ['change_value' => $bankTransferCountChange, 'status' => $bankTransferCountChangeStatus],
                    ],
                ],
                [
                    'heading' => "P2P",
                    'particulars' => ["Total Amount (Rs.)", "Total Count"],
                    'total_number' => "",
                    'data' => [$userToUserFundTransferAmount, $userToUserFundTransferCount],
                    'previous_day_report' => [$userToUserPreviousFundTransferAmount, $userToUserPreviousFundTransferCount],
                    'change' => [
                        ['change_value' => $userToUserFundTransferAmountChange, 'status' => $userToUserFundTransferAmountChangeStatus],
                        ['change_value' => $userToUserFundTransferCountChange, 'status' => $userToUserFundTransferCountChangeStatus],
                    ],
                ],
            ];

            return view('WalletReport::DailyInfo.daily_info_report')->with(compact('reports'));
        }
    }

    public function changeStatus($change)
    {
        if ($change < 0) {
            $change = $change * -1;
            $status = "negative";
        } elseif ($change > 0) {
            $status = "positive";
        } else {
            $status = "zero";
        }
        return ['change' => $change, 'status' => $status];
    }

    public function changeCalculator($value, $previous_value)
    {
        return $value - $previous_value;
    }

    public function calculateKycDetails($kycs): array
    {
        $kyc_count = 0;
        $accepted_kyc = 0;
        $rejected_kyc = 0;
        $pending_kyc = 0;
        foreach ($kycs as $kyc) {
            if ($kyc->accept == 1) {
                $accepted_kyc++;
            } elseif ($kyc->accept === null) {
                $pending_kyc++;
            } elseif ($kyc->accept === 0) {
                $rejected_kyc++;
            }
            $kyc_count++;
        }
        return [
            'kyc_count' => $kyc_count,
            'accepted_kyc' => $accepted_kyc,
            'rejected_kyc' => $rejected_kyc,
            'pending_kyc' => $pending_kyc
        ];
    }


//            $agentTransactions = DB::connection('dpaisa')->select("SELECT * FROM transaction_events as t
//                                                        RIGHT JOIN agents as a ON a.user_id = t.user_id
//                                                        WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
//                                                      ");

    public function getUserTransactionDetails($date)
    {
        $sql = 'CREATE TEMPORARY TABLE only_users SELECT u.id FROM users u LEFT JOIN agents a ON u.id = a.user_id WHERE a.status != "ACCEPTED" OR a.user_id IS NULL';
        DB::connection('dpaisa')->unprepared($sql);

        $sql_two = 'SELECT COUNT(*) as count, SUM(t.amount) as total_amount
                    FROM transaction_events t
                    JOIN only_users u
                    ON t.user_id = u.id
                    WHERE date(t.created_at) = date(:date_at)';

        $total_transactions = DB::connection('dpaisa')->select($sql_two, ['date_at' => $date]);

        DB::connection('dpaisa')->select('DROP TEMPORARY TABLE only_users');

        return ['total_transaction' => $total_transactions[0]->total_amount, 'total_count' => $total_transactions[0]->count];
    }

    public function getAgentTransactionDetails($date)
    {
        $sql = "SELECT COUNT(*) as count, SUM(t.amount) as total_amount  FROM transaction_events as t
                RIGHT JOIN agents as a
                ON
                a.user_id = t.user_id
                WHERE t.user_id = a.user_id
                AND
                a.status = 'ACCEPTED'
                AND
                date(t.created_at) = date(:date_at)
                ";

        $total_transactions = DB::connection('dpaisa')->select($sql,['date_at' => $date]);

        return ['total_transaction' => $total_transactions[0]->total_amount, 'total_count' => $total_transactions[0]->count];
    }

    public function getTotalTransactionDetails($date)
    {
        $total_transactions = TransactionEvent::select(DB::raw('count(*) as count, sum(amount) as total_amount'))
            ->whereDate('created_at', '=', $date)
            ->get();  // amount is in paisa
        return ['total_transaction' => $total_transactions[0]->total_amount, 'total_count' => $total_transactions[0]->count];
    }

    public function getBankLoadDetails($date,$bankLoadDetails)
    {
        $total_transactions = TransactionEvent::select(DB::raw('count(*) as count, sum(amount) as total_amount'))
            ->whereIn('transaction_type', $bankLoadDetails)
            ->whereDate('created_at', '=', $date)
            ->get();
        return ['amount' => $total_transactions[0]->total_amount, 'count' => $total_transactions[0]->count];
    }

    public function getBankTransferDetails($date,$bankTransferDetails)
    {
        $total_transactions = TransactionEvent::select(DB::raw('count(*) as count, sum(amount) as total_amount'))
            ->whereIn('transaction_type', $bankTransferDetails)
            ->whereDate('created_at', '=', $date)
            ->get();
        return ['amount' => $total_transactions[0]->total_amount, 'count' => $total_transactions[0]->count];
    }

    public function userToUserTransferDetails($date)
    {
        $total_transactions = TransactionEvent::select(DB::raw('count(*) as count, sum(amount) as total_amount'))
            ->where('transaction_type', '=', UserToUserFundTransfer::class)
            ->orWhere('transaction_type', '=', FundRequest::class)
            ->whereDate('created_at', '=', $date)
            ->get();
        return ['amount' => $total_transactions[0]->total_amount / 2, 'count' => $total_transactions[0]->count / 2];

    }

}
