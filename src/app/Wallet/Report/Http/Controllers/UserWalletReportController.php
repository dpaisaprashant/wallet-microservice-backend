<?php


namespace App\Wallet\Report\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Wallet\Report\Repositories\NchlLoadReportRepository;
use App\Wallet\Report\Repositories\ReconciliationReportRepository;
use App\Wallet\Report\Repositories\UserReconciliationReportRepository;
use App\Wallet\Report\Traits\ReconciliationReportGenerator;
use Illuminate\Http\Request;

class UserWalletReportController extends Controller
{
    use ReconciliationReportGenerator;

    public function userReconciliationReport(Request $request)
    {
        $users = User::filter($request)->paginate(10);
        $userReconciliationReport = [];

        foreach($users as $user) {
            $repository = new UserReconciliationReportRepository($request, $user->id);

            $totalAmounts = $this->generateReport($repository);
            $totalAmounts = array_merge([
                "Received Fund" => [
                    "amount" => $repository->totalUserReceivedFundsAmount() / 100,
                    "count" => $repository->totalUserReceivedFundsCount(),
                    "transaction_type" => "credit"
                ],
                "Transfer Fund" => [
                    "amount" => $repository->totalUserTransferredFundsAmount() / 100,
                    "count" => $repository->totalUserTransferredFundsCount(),
                    "transaction_type" => "debit"
                ]
            ], $totalAmounts);

            $userReconciliationReport[$user->mobile_no] = [
                'user' => $user,
                'payment_amounts' => $totalAmounts,
                'total_amounts' => [
                    'load' => $repository->totalLoadAmount() / 100,
                    'payment' => $repository->totalPaymentAmount() / 100,
                    'load_minus_payment' => ($repository->totalLoadAmount() - $repository->totalPaymentAmount()) / 100
                ]
            ];

        }


        return view('WalletReport::reconciliation.userReport')->with(compact('users', 'userReconciliationReport'));
    }

}
