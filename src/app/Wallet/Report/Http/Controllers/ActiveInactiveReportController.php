<?php


namespace App\Wallet\Report\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\User;
use App\Traits\CollectionPaginate;
use App\Wallet\Report\Repositories\AbstractReportRepository;
use App\Wallet\Report\Repositories\ActiveInactiveCustomerReportRepository;
use App\Wallet\Report\Repositories\AgentReportRepository;
use App\Wallet\Report\Repositories\NonBankPaymentReportRepository;
use App\Wallet\Report\Repositories\NrbAnnexCustomerPaymentReportRepository;
use App\Wallet\Report\Repositories\NrbAnnexMerchantPaymentReportRepository;
use App\Wallet\Report\Repositories\NrbAnnexPaymentReportRepository;
use App\Wallet\Report\Repositories\StatementSettlementBankRepository;
use App\Wallet\WalletAPI\Microservice\WalletClearanceMicroService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActiveInactiveReportController extends Controller
{
    use CollectionPaginate;

    public function activeInactiveSlab(Request $request)
    {
        $repository = new ActiveInactiveCustomerReportRepository($request);

        $check = $repository->checkForReport();

        if ($check == null) {
            $walletClearance =new WalletClearanceMicroService();

            $walletClearanceResponse=$walletClearance->dispatchStatementSettlementJobs(request(),request()->from);
            $statementSettlementBanks=$walletClearanceResponse['message'];

            return view('WalletReport::nrbAnnex.statement-settlement-bank', compact('statementSettlementBanks'));
        }
        if ($check) {
            if ($check->status == "PROCESSING") {
                $statementSettlementBanks='Generating Report .....';
                return view('WalletReport::nrbAnnex.statement-settlement-bank',compact('statementSettlementBanks'));
            }
        }

        $statementSettlementBanks = [
            'NPAY' => [
                'debit' => 0,
                'credit' => ($repository->getCreditByTitle($check->id, "NPAY")) ?? 0
            ],

            'NPS' => [
                'debit' => 0,
                'credit' => ($repository->getCreditByTitle($check->id, "NPS")) ?? 0
            ],

            'NCHL LOAD' => [
                'debit' => 0,
                'credit' => ($repository->getCreditByTitle($check->id, "NCHL_LOAD")) ?? 0
            ],

            'NCHL Aggregated' => [
                'debit' => $repository->getCreditByTitle($check->id, "NCHL_AGG"),
                'credit' => 0
            ],

            'CyberSource' => [
                'debit' => 0,
                'credit' => ($repository->getCreditByTitle($check->id, "NCHL_CYBERSOURCE")) ?? 0
            ],

            'PayPoint Advance' => [
                'debit' => $repository->getCreditByTitle($check->id, "PP_ADVANCE"),
                'credit' => 0
            ],
        ];

        return view('WalletReport::nrbAnnex.statement-settlement-bank')->with(compact('statementSettlementBanks'));
    }
}
