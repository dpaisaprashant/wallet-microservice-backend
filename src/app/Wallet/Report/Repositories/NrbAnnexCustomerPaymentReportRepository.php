<?php


namespace App\Wallet\Report\Repositories;


use App\Models\CellPayUserTransaction;
use App\Models\FundRequest;
use App\Models\KhaltiUserTransaction;
use App\Models\MerchantTransaction;
use App\Models\Microservice\PreTransaction;
use App\Models\NchlAggregatedPayment;
use App\Models\NchlBankTransfer;
use App\Models\NchlLoadTransaction;
use App\Models\NICAsiaCyberSourceLoadTransaction;
use App\Models\NPSAccountLinkLoad;
use App\Models\NtcRetailerToCustomerTransaction;
use App\Models\PaymentNepalLoadTransaction;
use App\Models\TransactionEvent;
use App\Models\UsedUserReferral;
use App\Models\UserLoadTransaction;
use App\Models\UserMerchantEventTicketPayment;
use App\Models\UserReferralBonusTransaction;
use App\Models\UserToUserFundTransfer;
use App\Models\UserTransaction;
use App\Wallet\Commission\Models\Commission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NrbAnnexCustomerPaymentReportRepository extends AbstractReportRepository
{
    protected $fromDate;
    protected $fromAmount;
    protected $toDate;
    protected $toAmount;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->fromDate = date('Y-m-d', strtotime(str_replace(',', ' ', $request->from)));
        $this->toDate = date('Y-m-d', strtotime(str_replace(',', ' ', $request->to)));
        $this->fromAmount = $request->fromAmount;
        $this->toAmount = $request->toAmount;
    }

    public function customerTransactions()
    {
        $customerTransactions = DB::connection('dpaisa')->select("CREATE TEMPORARY TABLE temp_agents
SELECT user_id FROM agents WHERE STATUS = 'ACCEPTED';

SELECT COUNT(*)
FROM transaction_events t
LEFT JOIN temp_agents a ON a.user_id = t.user_id
WHERE a.user_id IS NULL

                                                      ");

        return $customerTransactions;
    }

    public function getBillPaymentCount()
    {
        $sql = "CREATE TEMPORARY TABLE temp_agents
SELECT user_id FROM agents WHERE STATUS = 'ACCEPTED';";

        DB::connection('dpaisa')->unprepared($sql);

        $sql2 = "SELECT COUNT(t.amount/100) as totalCount
                    FROM transaction_events t
                    LEFT JOIN temp_agents a ON a.user_id = t.user_id
                    WHERE a.user_id IS NULL
                    AND
                    (t.transaction_type ='App\\\Models\\\NchlAggregatedPayment'
                     OR
                     t.transaction_type = 'App\\\Models\\\UserMerchantEventTicketPayment'
                     OR
                     t.transaction_type = 'App\\\Models\\\UserTransaction'
                    )
                    AND
                    date(t.created_at) >= date('$this->fromDate')
                    AND
                    date(t.created_at) <= date('$this->toDate')
                    AND
                    (t.amount/100) > '$this->fromAmount' and (t.amount/100) <= '$this->toAmount';";

        $billPaymentTotalCount = DB::connection('dpaisa')->select($sql2);

        $billPaymentTotalCount = $billPaymentTotalCount[0]->totalCount;

        return $billPaymentTotalCount;
    }

    public function getBillPaymentValue()
    {

//        $sql = "CREATE TEMPORARY TABLE temp_agents
//SELECT user_id FROM agents WHERE STATUS = 'ACCEPTED';";
//
//        DB::connection('dpaisa')->unprepared($sql);

        $sql2 = "SELECT SUM(t.amount/100) as totalSum
                    FROM transaction_events t
                    LEFT JOIN temp_agents a ON a.user_id = t.user_id
                    WHERE a.user_id IS NULL
                    AND
                    (t.transaction_type ='App\\\Models\\\NchlAggregatedPayment'
                     OR
                     t.transaction_type = 'App\\\Models\\\UserMerchantEventTicketPayment'
                     OR
                     t.transaction_type = 'App\\\Models\\\UserTransaction'
                    )
                    AND
                    date(t.created_at) >= date('$this->fromDate')
                    AND
                    date(t.created_at) <= date('$this->toDate')
                    AND
                    (t.amount/100) > '$this->fromAmount' and (t.amount/100) <= '$this->toAmount';";

        $billPaymentTotalValue = DB::connection('dpaisa')->select($sql2);

        $billPaymentTotalValue = $billPaymentTotalValue[0]->totalSum;

        return $billPaymentTotalValue;
    }

    public function getTransferCount()
    {
        $transferTotalCount = DB::connection('dpaisa')->select("SELECT COUNT(t.amount/100) as totalCount
                                                                                FROM transaction_events t
                                                                                LEFT JOIN temp_agents a ON a.user_id = t.user_id
                                                                                WHERE a.user_id IS NULL
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\FundRequest'
                                                                                 OR
                                                                                 t.transaction_type = 'App\\\Models\\\UserToUserFundTransfer'
                                                                                )
                                                                                AND
                                                                                date(t.created_at) >= date('$this->fromDate')
                                                                                AND
                                                                                date(t.created_at) <= date('$this->toDate')
                                                                                AND
                                                                                (t.amount/100) > '$this->fromAmount' and (t.amount/100) <= '$this->toAmount'
                                                                               ");

        $transferTotalCount = $transferTotalCount[0]->totalCount;
        return $transferTotalCount;
    }

    public function getTransferValue()
    {
        $transferTotalValue = DB::connection('dpaisa')->select("SELECT SUM(t.amount/100) as totalSum
                                                                                FROM transaction_events t
                                                                                LEFT JOIN temp_agents a ON a.user_id = t.user_id
                                                                                WHERE a.user_id IS NULL
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\FundRequest'
                                                                                 OR
                                                                                 t.transaction_type = 'App\\\Models\\\UserToUserFundTransfer'
                                                                                )
                                                                                AND
                                                                                date(t.created_at) >= date('$this->fromDate')
                                                                                AND
                                                                                date(t.created_at) <= date('$this->toDate')
                                                                                AND
                                                                                (t.amount/100) > '$this->fromAmount' and (t.amount/100) <= '$this->toAmount'
                                                                               ");

        $transferTotalValue = $transferTotalValue[0]->totalSum;
        return $transferTotalValue;
    }

    public function getCashInCount()
    {
        $cashInTotalCount = DB::connection('dpaisa')->select("SELECT COUNT(t.amount/100) as totalCount
                                                                                FROM transaction_events t
                                                                                LEFT JOIN temp_agents a ON a.user_id = t.user_id
                                                                                WHERE a.user_id IS NULL
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\NchlLoadTransaction'
                                                                                 OR
                                                                                 t.transaction_type = 'App\\\Models\\\NICAsiaCyberSourceLoadTransaction'
                                                                                 OR
                                                                                 t.transaction_type = 'App\\\Models\\\NpsLoadTransaction'
                                                                                 OR
                                                                                 t.transaction_type = 'App\\\Models\\\UserLoadTransaction'
                                                                                )
                                                                                AND
                                                                                date(t.created_at) >= date('$this->fromDate')
                                                                                AND
                                                                                date(t.created_at) <= date('$this->toDate')
                                                                                AND
                                                                                (t.amount/100) > '$this->fromAmount' and (t.amount/100) <= '$this->toAmount'
                                                                               ");

        $cashInTotalCount = $cashInTotalCount[0]->totalCount;

        return $cashInTotalCount;
    }

    public function getCashInValue()
    {
        $cashInTotalValue = DB::connection('dpaisa')->select("SELECT SUM(t.amount/100) as totalSum
                                                                                FROM transaction_events t
                                                                                LEFT JOIN temp_agents a ON a.user_id = t.user_id
                                                                                WHERE a.user_id IS NULL
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\NchlLoadTransaction'
                                                                                 OR
                                                                                 t.transaction_type = 'App\\\Models\\\NICAsiaCyberSourceLoadTransaction'
                                                                                 OR
                                                                                 t.transaction_type = 'App\\\Models\\\NpsLoadTransaction'
                                                                                 OR
                                                                                 t.transaction_type = 'App\\\Models\\\UserLoadTransaction'
                                                                                )
                                                                                AND
                                                                                date(t.created_at) >= date('$this->fromDate')
                                                                                AND
                                                                                date(t.created_at) <= date('$this->toDate')
                                                                                AND
                                                                                (t.amount/100) > '$this->fromAmount' and (t.amount/100) <= '$this->toAmount'
                                                                               ");

        $cashInTotalValue = $cashInTotalValue[0]->totalSum;
        return $cashInTotalValue;
    }

    public function getOfferNumber()
    {
        $cashBackOfferTotalNumber = DB::connection('dpaisa')->select("SELECT COUNT(t.amount/100) as totalCount
                                                                                FROM transaction_events t
                                                                                LEFT JOIN temp_agents a ON a.user_id = t.user_id
                                                                                WHERE a.user_id IS NULL
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\UsedUserReferral'
                                                                                 OR
                                                                                 t.transaction_type = 'App\\\Models\\\UserReferralBonusTransaction'
                                                                                 OR
                                                                                 (t.transaction_type = 'App\\\Wallet\\Commission\\\Models\\\Commission' AND t.service_type='CASHBACK')
                                                                                     OR
                                                                                 (t.transaction_type = 'App\\\Models\\\LoadTestFund' AND t.service_type='LUCKY WINNER')
                                                                                )
                                                                                AND
                                                                                date(t.created_at) >= date('$this->fromDate')
                                                                                AND
                                                                                date(t.created_at) <= date('$this->toDate')
                                                                                AND
                                                                                (t.amount/100) > '$this->fromAmount' and (t.amount/100) <= '$this->toAmount'
                                                                               ");

        $cashBackOfferTotalNumber = $cashBackOfferTotalNumber[0]->totalCount;
        return $cashBackOfferTotalNumber;
    }

    public function getOfferValue()
    {
        $cashBackOfferTotalValue = DB::connection('dpaisa')->select("SELECT SUM(t.amount/100) as totalSum
                                                                                FROM transaction_events t
                                                                                LEFT JOIN temp_agents a ON a.user_id = t.user_id
                                                                                WHERE a.user_id IS NULL
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\UsedUserReferral'
                                                                                 OR
                                                                                 t.transaction_type = 'App\\\Models\\\UserReferralBonusTransaction'
                                                                                 OR
                                                                                 (t.transaction_type = 'App\\\Wallet\\Commission\\\Models\\\Commission' AND t.service_type='CASHBACK')
                                                                                     OR
                                                                                 (t.transaction_type = 'App\\\Models\\\LoadTestFund' AND t.service_type='LUCKY WINNER')
                                                                                )
                                                                                AND
                                                                                date(t.created_at) >= date('$this->fromDate')
                                                                                AND
                                                                                date(t.created_at) <= date('$this->toDate')
                                                                                AND
                                                                                (t.amount/100) > '$this->fromAmount' and (t.amount/100) <= '$this->toAmount'
                                                                               ");

        $cashBackOfferTotalValue = $cashBackOfferTotalValue[0]->totalSum;
        return $cashBackOfferTotalValue;
    }

    public function getFeesChargesNumber()
    {
        $commissionTotalNumber = DB::connection('dpaisa')->select("SELECT COUNT(t.amount/100) as totalCount
                                                                                FROM transaction_events t
                                                                                LEFT JOIN temp_agents a ON a.user_id = t.user_id
                                                                                WHERE a.user_id IS NULL
                                                                                AND
                                                                                (t.transaction_type ='App\\\Wallet\\\Commission\\\Models\\\Commission'
                                                                                 OR
                                                                                 (t.transaction_type = 'App\\\Wallet\\Commission\\\Models\\\Commission' AND t.service_type='COMMISSION')
                                                                                )
                                                                                AND
                                                                                date(t.created_at) >= date('$this->fromDate')
                                                                                AND
                                                                                date(t.created_at) <= date('$this->toDate')
                                                                                AND
                                                                                (t.amount/100) > '$this->fromAmount' and (t.amount/100) <= '$this->toAmount'
                                                                               ");

        $commissionTotalNumber = $commissionTotalNumber[0]->totalCount;
        return $commissionTotalNumber;
    }

    public function getFeesChargesValue()
    {
        $commissionTotalValue = DB::connection('dpaisa')->select("SELECT SUM(t.amount/100) as totalSum
                                                                                FROM transaction_events t
                                                                                LEFT JOIN temp_agents a ON a.user_id = t.user_id
                                                                                WHERE a.user_id IS NULL
                                                                                AND
                                                                                (t.transaction_type ='App\\\Wallet\\\Commission\\\Models\\\Commission'
                                                                                 OR
                                                                                 (t.transaction_type = 'App\\\Wallet\\Commission\\\Models\\\Commission' AND t.service_type='COMMISSION')
                                                                                )
                                                                                AND
                                                                                date(t.created_at) >= date('$this->fromDate')
                                                                                AND
                                                                                date(t.created_at) <= date('$this->toDate')
                                                                                AND
                                                                                (t.amount/100) > '$this->fromAmount' and (t.amount/100) <= '$this->toAmount'
                                                                               ");

        $commissionTotalValue = $commissionTotalValue[0]->totalSum;
        return $commissionTotalValue;
    }

    public function getCashOutNumber()
    {
        $cashOutTotalNumber = DB::connection('dpaisa')->select("SELECT COUNT(t.amount/100) as totalCount
                                                                                FROM transaction_events t
                                                                                LEFT JOIN temp_agents a ON a.user_id = t.user_id
                                                                                WHERE a.user_id IS NULL
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\NchlBankTransfer'
                                                                                )
                                                                                AND
                                                                                date(t.created_at) >= date('$this->fromDate')
                                                                                AND
                                                                                date(t.created_at) <= date('$this->toDate')
                                                                                AND
                                                                                (t.amount/100) > '$this->fromAmount' and (t.amount/100) <= '$this->toAmount'
                                                                               ");

        $cashOutTotalNumber = $cashOutTotalNumber[0]->totalCount;
        return $cashOutTotalNumber;
    }

    public function getCashOutValue()
    {
        $cashOutTotalValue = DB::connection('dpaisa')->select("SELECT SUM(t.amount/100) as totalSum
                                                                                FROM transaction_events t
                                                                                LEFT JOIN temp_agents a ON a.user_id = t.user_id
                                                                                WHERE a.user_id IS NULL
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\NchlBankTransfer'
                                                                                )
                                                                                AND
                                                                                date(t.created_at) >= date('$this->fromDate')
                                                                                AND
                                                                                date(t.created_at) <= date('$this->toDate')
                                                                                AND
                                                                                (t.amount/100) > '$this->fromAmount' and (t.amount/100) <= '$this->toAmount'
                                                                               ");

        $cashOutTotalValue = $cashOutTotalValue[0]->totalSum;
        return $cashOutTotalValue;
    }

    public function getQRPaymentCount()
    {
        $qrPaymentCount = DB::connection('dpaisa')->select("SELECT COUNT(t.amount/100) as totalCount
                                                                                FROM transaction_events t
                                                                                LEFT JOIN temp_agents a ON a.user_id = t.user_id
                                                                                WHERE a.user_id IS NULL
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\MerchantTransaction'
                                                                                    OR
                                                                                t.transaction_type ='App\\\Models\\\UserMerchantEventTicketPayment'
                                                                                 )
                                                                                AND
                                                                                date(t.created_at) >= date('$this->fromDate')
                                                                                AND
                                                                                date(t.created_at) <= date('$this->toDate')
                                                                                AND
                                                                                (t.amount/100) > '$this->fromAmount' and (t.amount/100) <= '$this->toAmount'
                                                                               ");

        $qrPaymentCount = $qrPaymentCount[0]->totalCount;
        return $qrPaymentCount;
    }

    public function getQRPaymentValue()
    {
        $qrPaymentValue = DB::connection('dpaisa')->select("SELECT SUM(t.amount/100) as totalSum
                                                                                FROM transaction_events t
                                                                                LEFT JOIN temp_agents a ON a.user_id = t.user_id
                                                                                WHERE a.user_id IS NULL
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\MerchantTransaction'
                                                                                    OR
                                                                                t.transaction_type ='App\\\Models\\\UserMerchantEventTicketPayment'
                                                                                 )
                                                                                AND
                                                                                date(t.created_at) >= date('$this->fromDate')
                                                                                AND
                                                                                date(t.created_at) <= date('$this->toDate')
                                                                                AND
                                                                                (t.amount/100) > '$this->fromAmount' and (t.amount/100) <= '$this->toAmount'
                                                                               ");

        $qrPaymentValue = $qrPaymentValue[0]->totalSum;
        return $qrPaymentValue;
    }

    public function getServiceRefundCount()
    {
        $serviceRefundCount = DB::connection('dpaisa')->select("SELECT COUNT(t.amount/100) as totalCount
                                                                                FROM transaction_events t
                                                                                LEFT JOIN temp_agents a ON a.user_id = t.user_id
                                                                                WHERE a.user_id IS NULL
                                                                                AND
                                                                                (
                                                                                    t.transaction_type ='App\\\Models\\\LoadTestFund' AND t.service_type='REFUND' AND t.pre_transaction_id=NULL
                                                                                 )
                                                                                AND
                                                                                date(t.created_at) >= date('$this->fromDate')
                                                                                AND
                                                                                date(t.created_at) <= date('$this->toDate')
                                                                                AND
                                                                                (t.amount/100) > '$this->fromAmount' and (t.amount/100) <= '$this->toAmount'
                                                                               ");

        $serviceRefundCount = $serviceRefundCount[0]->totalCount;
        return $serviceRefundCount;
    }

    public function getServiceRefundValue()
    {
        $serviceRefundValue = DB::connection('dpaisa')->select("SELECT SUM(t.amount/100) as totalSum
                                                                                FROM transaction_events t
                                                                                LEFT JOIN temp_agents a ON a.user_id = t.user_id
                                                                                WHERE a.user_id IS NULL
                                                                                AND
                                                                                (
                                                                                    t.transaction_type ='App\\\Models\\\LoadTestFund' AND t.service_type='REFUND' AND t.pre_transaction_id=NULL
                                                                                 )
                                                                                AND
                                                                                date(t.created_at) >= date('$this->fromDate')
                                                                                AND
                                                                                date(t.created_at) <= date('$this->toDate')
                                                                                AND
                                                                                (t.amount/100) > '$this->fromAmount' and (t.amount/100) <= '$this->toAmount'
                                                                               ");

        $serviceRefundValue = $serviceRefundValue[0]->totalSum;
        return $serviceRefundValue;
    }

//    public function getServiceRefundTotalCount()
//    {
//        $serviceRefundTotal = DB::connection('dpaisa')->select("SELECT COUNT(t.amount/100) as totalCount FROM transaction_events as t
//                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
//                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
//                                                                                AND
//                                                                                (
//                                                                                    t.transaction_type ='App\\\Models\\\LoadTestFund' AND t.service_type='REFUND' AND t.pre_transaction_id=NULL
//                                                                                 )
//                                                                                AND
//                                                                                date(t.created_at) >= date('$this->fromDate')
//                                                                                AND
//                                                                                date(t.created_at) <= date('$this->toDate')
//                                                                               ");
//
//        $serviceRefundTotal = $serviceRefundTotal[0]->totalCount;
//        return $serviceRefundTotal;
//    }
//
//    public function getServiceRefundTotalValue()
//    {
//        $serviceRefundTotal = DB::connection('dpaisa')->select("SELECT SUM(t.amount/100) as totalSum FROM transaction_events as t
//                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
//                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
//                                                                                AND
//                                                                                (
//                                                                                    t.transaction_type ='App\\\Models\\\LoadTestFund' AND t.service_type='REFUND' AND t.pre_transaction_id=NULL
//                                                                                 )
//                                                                                AND
//                                                                                date(t.created_at) >= date('$this->fromDate')
//                                                                                AND
//                                                                                date(t.created_at) <= date('$this->toDate')
//                                                                               ");
//
//        $serviceRefundTotal = $serviceRefundTotal[0]->totalSum;
//        return $serviceRefundTotal;
//    }


    public function checkCountMerchantTransactions()
    {

        $successfulCountMerchantTransactions = MerchantTransaction::where('status', 'COMPLETE')->filter($this->request)->count();
        $merchantTransactions = MerchantTransaction::filter($this->request)->count();

        $failedCountMerchantTransactions = $merchantTransactions - $successfulCountMerchantTransactions;

        $merchantTransactionsCount = ['successfulCountMerchantTransactions' => $successfulCountMerchantTransactions,
            'failedCountMerchantTransactions' => $failedCountMerchantTransactions,
        ];
        return $merchantTransactionsCount;
    }

    public function checkCountUserToUserFundTransfer()
    {
        $userToUserFundTransferCount = UserToUserFundTransfer::filter($this->request)->count();
        $fundRequestsCount = FundRequest::where('status', 1)->filter($this->request)->count();
        $successfulCountUserToUserFundTransfer = $userToUserFundTransferCount + $fundRequestsCount;

        $failedCountUserToUserFundTransfer = 0;

        $userToUserFundTransferCount = ['successfulCountUserToUserFundTransfer' => $successfulCountUserToUserFundTransfer,
            'failedCountUserToUserFundTransfer' => $failedCountUserToUserFundTransfer,
        ];
        return $userToUserFundTransferCount;
    }

    public function checkCountKhaltiPayment()
    {

        $khaltiPayment = KhaltiUserTransaction::where('vendor', 'NCELL')->orWhere('vendor', 'NTC')->orWhere('vendor', 'SMARTCELL')->filter($this->request);
        $successfulCountKhaltiPayment = $khaltiPayment->where('state', 'success')->filter($this->request)->count();
        $failedCountKhaltiPayment = ($khaltiPayment->count()) - $successfulCountKhaltiPayment;

        $khaltiPaymentCount = ['successfulKhaltiPaymentCount' => $successfulCountKhaltiPayment,
            'failedKhaltiPaymentCount' => $failedCountKhaltiPayment,
        ];

        return $khaltiPaymentCount;
    }

    public function checkCountNchlAggregated()
    {

        $successfulCountNchlAggregated = TransactionEvent::where('transaction_type', NchlAggregatedPayment::class)->filter($this->request)->count();
        $nchlAggregated = NchlAggregatedPayment::filter($this->request)->count();

        $failedCountNchlAggregated = $nchlAggregated - $successfulCountNchlAggregated;

        $nchlAggregatedCount = ['successfulNchlAggregatedCount' => $successfulCountNchlAggregated,
            'failedNchlAggregatedCount' => $failedCountNchlAggregated,
        ];
        return $nchlAggregatedCount;
    }

    public function checkCountNchlBankTransfer()
    {

        $successfulCountNchlBankTransfer = TransactionEvent::where('transaction_type', NchlAggregatedPayment::class)->filter($this->request)->count();
        $nchlBankTransfer = NchlBankTransfer::filter($this->request)->count();

        $failedCountNchlBankTransfer = $nchlBankTransfer - $successfulCountNchlBankTransfer;

        $nchlBankTransferCount = ['successfulNchlBankTransferCount' => $successfulCountNchlBankTransfer,
            'failedNchlBankTransferCount' => $failedCountNchlBankTransfer,
        ];
        return $nchlBankTransferCount;
    }

    public function checkCountCashIn()
    {

        $successfulCountCashIn = $this->getCashInNumber();
        $totalCashInCount = UserLoadTransaction::filter($this->request)->count() +
            NchlLoadTransaction::filter($this->request)->count() +
            NICAsiaCyberSourceLoadTransaction::filter($this->request)->count() +
            NPSAccountLinkLoad::filter($this->request)->count();
//            PaymentNepalLoadTransaction::filter($this->request)->count();
        $failedCountCashIn = $totalCashInCount - $successfulCountCashIn;

        $cashInCount = ['successfulCashInCount' => $successfulCountCashIn,
            'failedCashInCount' => $failedCountCashIn,
        ];
        return $cashInCount;
    }

    public function checkCountCashOut()
    {

        $successfulCountCashOut = $this->getCashOutNumber();
        $totalCashOutCount = NchlBankTransfer::filter($this->request)->count();
        $failedCountCashOut = $totalCashOutCount - $successfulCountCashOut;

        $cashInCount = ['successfulCashOutCount' => $successfulCountCashOut,
            'failedCashOutCount' => $failedCountCashOut,
        ];
        return $cashInCount;
    }

}
