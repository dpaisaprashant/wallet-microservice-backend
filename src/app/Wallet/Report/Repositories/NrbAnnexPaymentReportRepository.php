<?php


namespace App\Wallet\Report\Repositories;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NrbAnnexPaymentReportRepository extends AbstractReportRepository
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
        $this->fromAmount = $request->from_amount;
        $this->toAmount = $request->to_amount;
//        dd($this->toAmount);
    }

    public function agentTransactions()
    {
        $agentTransactions = DB::connection('dpaisa')->select("SELECT * FROM transaction_events as t
                                                        RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                        WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
                                                      ");

        return $agentTransactions;
    }

    public function getBillPaymentCount()
    {
        $billPaymentTotalCount = DB::connection('dpaisa')->select("SELECT COUNT(t.amount/100) as totalCount FROM transaction_events as t
                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\NchlAggregatedPayment'
                                                                                 OR
                                                                                 t.transaction_type = 'App\\\Models\\\UserMerchantEventTicketPayment'
                                                                                 OR
                                                                                 t.transaction_type = 'App\\\Models\\\UserTransaction'
                                                                                )
                                                                                AND
                                                                                date(t.created_at) >= date(:fromDate)
                                                                                AND
                                                                                date(t.created_at) <= date(:toDate)
                                                                                AND
                                                                                (t.amount/100) > :fromAmount and (t.amount/100) <= :toAmount
                                                                               ",['fromDate'=>$this->fromDate,'toDate'=>$this->toDate,'fromAmount'=>$this->fromAmount,'toAmount'=>$this->toAmount]);

        $billPaymentTotalCount = $billPaymentTotalCount[0]->totalCount;

        return $billPaymentTotalCount;
    }

    public function getBillPaymentValue()
    {

        $billPaymentTotalValue = DB::connection('dpaisa')->select("SELECT SUM(t.amount/100) as totalSum FROM transaction_events as t
                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\NchlAggregatedPayment'
                                                                                 OR
                                                                                 t.transaction_type = 'App\\\Models\\\UserMerchantEventTicketPayment'
                                                                                 OR
                                                                                 t.transaction_type = 'App\\\Models\\\UserTransaction'
                                                                                )
                                                                                AND
                                                                                date(t.created_at) >= date(:fromDate)
                                                                                AND
                                                                                date(t.created_at) <= date(:toDate)
                                                                                AND
                                                                                (t.amount/100) > :fromAmount and (t.amount/100) <= :toAmount
                                                                               ",['fromDate'=>$this->fromDate,'toDate'=>$this->toDate,'fromAmount'=>$this->fromAmount,'toAmount'=>$this->toAmount]);
        $billPaymentTotalValue = $billPaymentTotalValue[0]->totalSum;

        return $billPaymentTotalValue;
    }

    public function getTransferCount()
    {
        $transferTotalCount = DB::connection('dpaisa')->select("SELECT COUNT(t.amount/100) as totalCount FROM transaction_events as t
                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\FundRequest'
                                                                                 OR
                                                                                 t.transaction_type = 'App\\\Models\\\UserToUserFundTransfer'
                                                                                )
                                                                                AND
                                                                                date(t.created_at) >= date(:fromDate)
                                                                                AND
                                                                                date(t.created_at) <= date(:toDate)
                                                                                AND
                                                                                (t.amount/100) > :fromAmount and (t.amount/100) <= :toAmount
                                                                               ",['fromDate'=>$this->fromDate,'toDate'=>$this->toDate,'fromAmount'=>$this->fromAmount,'toAmount'=>$this->toAmount]);

        $transferTotalCount = $transferTotalCount[0]->totalCount;
        return $transferTotalCount;
    }

    public function getTransferValue()
    {
        $transferTotalValue = DB::connection('dpaisa')->select("SELECT SUM(t.amount/100) as totalSum FROM transaction_events as t
                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\FundRequest'
                                                                                 OR
                                                                                 t.transaction_type = 'App\\\Models\\\UserToUserFundTransfer'
                                                                                )
                                                                                AND
                                                                                date(t.created_at) >= date(:fromDate)
                                                                                AND
                                                                                date(t.created_at) <= date(:toDate)
                                                                                AND
                                                                                (t.amount/100) > :fromAmount and (t.amount/100) <= :toAmount
                                                                               ",['fromDate'=>$this->fromDate,'toDate'=>$this->toDate,'fromAmount'=>$this->fromAmount,'toAmount'=>$this->toAmount]);

        $transferTotalValue = $transferTotalValue[0]->totalSum;
        return $transferTotalValue;
    }

    public function getCashInCount()
    {
        $cashInTotalCount = DB::connection('dpaisa')->select("SELECT COUNT(t.amount/100) as totalCount FROM transaction_events as t
                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
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
                                                                                date(t.created_at) >= date(:fromDate)
                                                                                AND
                                                                                date(t.created_at) <= date(:toDate)
                                                                                AND
                                                                                (t.amount/100) > :fromAmount and (t.amount/100) <= :toAmount
                                                                               ",['fromDate'=>$this->fromDate,'toDate'=>$this->toDate,'fromAmount'=>$this->fromAmount,'toAmount'=>$this->toAmount]);

        $cashInTotalCount = $cashInTotalCount[0]->totalCount;

        return $cashInTotalCount;
    }

    public function getCashInValue()
    {
        $cashInTotalValue = DB::connection('dpaisa')->select("SELECT SUM(t.amount/100) as totalSum FROM transaction_events as t
                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
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
                                                                                date(t.created_at) >= date(:fromDate)
                                                                                AND
                                                                                date(t.created_at) <= date(:toDate)
                                                                                AND
                                                                                (t.amount/100) > :fromAmount and (t.amount/100) <= :toAmount
                                                                               ",['fromDate'=>$this->fromDate,'toDate'=>$this->toDate,'fromAmount'=>$this->fromAmount,'toAmount'=>$this->toAmount]);

        $cashInTotalValue = $cashInTotalValue[0]->totalSum;
        return $cashInTotalValue;
    }

    public function getOfferNumber()
    {
        $cashBackOfferTotalNumber = DB::connection('dpaisa')->select("SELECT COUNT(t.amount/100) as totalCount FROM transaction_events as t
                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\UsedUserReferral'
                                                                                 OR
                                                                                 t.transaction_type = 'App\\\Models\\\UserReferralBonusTransaction'
                                                                                 OR
                                                                                 (t.transaction_type = 'App\\\Wallet\\\Commission\\\Models\\\Commission' AND (t.service_type='CASHBACK' OR t.service_type='AGENT_CASHBACK'))
                                                                                     OR
                                                                                 (t.transaction_type = 'App\\\Models\\\LoadTestFund' AND t.service_type='LUCKY WINNER')
                                                                                )
                                                                                AND
                                                                                date(t.created_at) >= date(:fromDate)
                                                                                AND
                                                                                date(t.created_at) <= date(:toDate)
                                                                                AND
                                                                                (t.amount/100) > :fromAmount and (t.amount/100) <= :toAmount
                                                                               ",['fromDate'=>$this->fromDate,'toDate'=>$this->toDate,'fromAmount'=>$this->fromAmount,'toAmount'=>$this->toAmount]);

        $cashBackOfferTotalNumber = $cashBackOfferTotalNumber[0]->totalCount;
        return $cashBackOfferTotalNumber;
    }

    public function getOfferValue()
    {
        $cashBackOfferTotalValue = DB::connection('dpaisa')->select("SELECT SUM(t.amount/100) as totalSum FROM transaction_events as t
                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\UsedUserReferral'
                                                                                 OR
                                                                                 t.transaction_type = 'App\\\Models\\\UserReferralBonusTransaction'
                                                                                 OR
                                                                                 (t.transaction_type = 'App\\\Wallet\\\Commission\\\Models\\\Commission' AND (t.service_type='CASHBACK' OR t.service_type='AGENT_CASHBACK'))
                                                                                     OR
                                                                                 (t.transaction_type = 'App\\\Models\\\LoadTestFund' AND t.service_type='LUCKY WINNER')
                                                                                )
                                                                                AND
                                                                                date(t.created_at) >= date(:fromDate)
                                                                                AND
                                                                                date(t.created_at) <= date(:toDate)
                                                                                AND
                                                                                (t.amount/100) > :fromAmount and (t.amount/100) <= :toAmount
                                                                               ",['fromDate'=>$this->fromDate,'toDate'=>$this->toDate,'fromAmount'=>$this->fromAmount,'toAmount'=>$this->toAmount]);

        $cashBackOfferTotalValue = $cashBackOfferTotalValue[0]->totalSum;
        return $cashBackOfferTotalValue;
    }

    public function getFeesChargesNumber()
    {
        $commissionTotalNumber = DB::connection('dpaisa')->select("SELECT COUNT(t.amount/100) as totalCount FROM transaction_events as t
                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
                                                                                AND
                                                                                 (t.transaction_type = 'App\\\Wallet\\\Commission\\\Models\\\Commission' AND t.service_type='COMMISSION')
                                                                                AND
                                                                                date(t.created_at) >= date(:fromDate)
                                                                                AND
                                                                                date(t.created_at) <= date(:toDate)
                                                                                AND
                                                                                (t.amount/100) > :fromAmount and (t.amount/100) <= :toAmount
                                                                               ",['fromDate'=>$this->fromDate,'toDate'=>$this->toDate,'fromAmount'=>$this->fromAmount,'toAmount'=>$this->toAmount]);

        $commissionTotalNumber = $commissionTotalNumber[0]->totalCount;
        return $commissionTotalNumber;
    }

    public function getFeesChargesValue()
    {
        $commissionTotalValue = DB::connection('dpaisa')->select("SELECT SUM(t.amount/100) as totalSum FROM transaction_events as t
                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
                                                                                AND
                                                                                 (t.transaction_type = 'App\\\Wallet\\\Commission\\\Models\\\Commission' AND t.service_type='COMMISSION')
                                                                                AND
                                                                                date(t.created_at) >= date(:fromDate)
                                                                                AND
                                                                                date(t.created_at) <= date(:toDate)
                                                                                AND
                                                                                (t.amount/100) > :fromAmount and (t.amount/100) <= :toAmount
                                                                               ",['fromDate'=>$this->fromDate,'toDate'=>$this->toDate,'fromAmount'=>$this->fromAmount,'toAmount'=>$this->toAmount]);

        $commissionTotalValue = $commissionTotalValue[0]->totalSum;
        return $commissionTotalValue;
    }

    public function getCashOutNumber()
    {
        $cashOutTotalNumber = DB::connection('dpaisa')->select("SELECT COUNT(t.amount/100) as totalCount FROM transaction_events as t
                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\NchlBankTransfer'
                                                                                )
                                                                                AND
                                                                                date(t.created_at) >= date(:fromDate)
                                                                                AND
                                                                                date(t.created_at) <= date(:toDate)
                                                                                AND
                                                                                (t.amount/100) > :fromAmount and (t.amount/100) <= :toAmount
                                                                               ",['fromDate'=>$this->fromDate,'toDate'=>$this->toDate,'fromAmount'=>$this->fromAmount,'toAmount'=>$this->toAmount]);

        $cashOutTotalNumber = $cashOutTotalNumber[0]->totalCount;
        return $cashOutTotalNumber;
    }

    public function getCashOutValue()
    {
        $cashOutTotalValue = DB::connection('dpaisa')->select("SELECT SUM(t.amount/100) as totalSum FROM transaction_events as t
                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\NchlBankTransfer'
                                                                                )
                                                                                AND
                                                                                date(t.created_at) >= date(:fromDate)
                                                                                AND
                                                                                date(t.created_at) <= date(:toDate)
                                                                                AND
                                                                                (t.amount/100) > :fromAmount and (t.amount/100) <= :toAmount
                                                                               ",['fromDate'=>$this->fromDate,'toDate'=>$this->toDate,'fromAmount'=>$this->fromAmount,'toAmount'=>$this->toAmount]);

        $cashOutTotalValue = $cashOutTotalValue[0]->totalSum;
        return $cashOutTotalValue;
    }

    public function getQRPaymentCount()
    {
        $qrPaymentCount = DB::connection('dpaisa')->select("SELECT COUNT(t.amount/100) as totalCount FROM transaction_events as t
                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\MerchantTransaction'
                                                                                    OR
                                                                                t.transaction_type ='App\\\Models\\\UserMerchantEventTicketPayment'
                                                                                 )
                                                                                AND
                                                                                date(t.created_at) >= date(:fromDate)
                                                                                AND
                                                                                date(t.created_at) <= date(:toDate)
                                                                                AND
                                                                                (t.amount/100) > :fromAmount and (t.amount/100) <= :toAmount
                                                                               ",['fromDate'=>$this->fromDate,'toDate'=>$this->toDate,'fromAmount'=>$this->fromAmount,'toAmount'=>$this->toAmount]);

        $qrPaymentCount = $qrPaymentCount[0]->totalCount;
        return $qrPaymentCount;
    }

    public function getQRPaymentValue()
    {
        $qrPaymentValue = DB::connection('dpaisa')->select("SELECT SUM(t.amount/100) as totalSum FROM transaction_events as t
                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
                                                                                AND
                                                                                (t.transaction_type ='App\\\Models\\\MerchantTransaction'
                                                                                    OR
                                                                                t.transaction_type ='App\\\Models\\\UserMerchantEventTicketPayment'
                                                                                 )
                                                                                AND
                                                                                date(t.created_at) >= date(:fromDate)
                                                                                AND
                                                                                date(t.created_at) <= date(:toDate)
                                                                                AND
                                                                                (t.amount/100) > :fromAmount and (t.amount/100) <= :toAmount
                                                                               ",['fromDate'=>$this->fromDate,'toDate'=>$this->toDate,'fromAmount'=>$this->fromAmount,'toAmount'=>$this->toAmount]);

        $qrPaymentValue = $qrPaymentValue[0]->totalSum;
        return $qrPaymentValue;
    }

    public function getServiceRefundCount()
    {
        $serviceRefundCount = DB::connection('dpaisa')->select("SELECT COUNT(t.amount/100) as totalCount FROM transaction_events as t
                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
                                                                                AND
                                                                                (
                                                                                    t.transaction_type ='App\\\Models\\\LoadTestFund' AND t.service_type='REFUND' AND t.pre_transaction_id IS NULL
                                                                                 )
                                                                                AND
                                                                                date(t.created_at) >= date(:fromDate)
                                                                                AND
                                                                                date(t.created_at) <= date(:toDate)
                                                                                AND
                                                                                (t.amount/100) > :fromAmount and (t.amount/100) <= :toAmount
                                                                               ",['fromDate'=>$this->fromDate,'toDate'=>$this->toDate,'fromAmount'=>$this->fromAmount,'toAmount'=>$this->toAmount]);

        $serviceRefundCount = $serviceRefundCount[0]->totalCount;
        return $serviceRefundCount;
    }

    public function getServiceRefundValue()
    {
        $serviceRefundValue = DB::connection('dpaisa')->select("SELECT SUM(t.amount/100) as totalSum FROM transaction_events as t
                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
                                                                                AND
                                                                                (
                                                                                    t.transaction_type ='App\\\Models\\\LoadTestFund' AND t.service_type='REFUND' AND t.pre_transaction_id IS NULL
                                                                                 )
                                                                                AND
                                                                                date(t.created_at) >= date(:fromDate)
                                                                                AND
                                                                                date(t.created_at) <= date(:toDate)
                                                                                AND
                                                                                (t.amount/100) > :fromAmount and (t.amount/100) <= :toAmount
                                                                               ",['fromDate'=>$this->fromDate,'toDate'=>$this->toDate,'fromAmount'=>$this->fromAmount,'toAmount'=>$this->toAmount]);

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
//                                                                                date(t.created_at) >= date(:fromDate)
//                                                                                AND
//                                                                                date(t.created_at) <= date(:toDate)
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


    public function getGovernmentPaymentCount()
    {
        $governmentPaymentCount = DB::connection('dpaisa')->select("SELECT COUNT(t.amount/100) as totalCount FROM transaction_events as t
                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
                                                                                AND
                                                                                (
                                                                                    t.transaction_type ='App\\\Models\\\NchlAggregatedPayment'
                                                                                 )
                                                                                AND
                                                                                date(t.created_at) >= date(:fromDate)
                                                                                AND
                                                                                date(t.created_at) <= date(:toDate)
                                                                                AND
                                                                                (t.amount/100) > :fromAmount and (t.amount/100) <= :toAmount
                                                                               ",['fromDate'=>$this->fromDate,'toDate'=>$this->toDate,'fromAmount'=>$this->fromAmount,'toAmount'=>$this->toAmount]);

        $governmentPaymentCount = $governmentPaymentCount[0]->totalCount;
        return $governmentPaymentCount;
    }

    public function getGovernmentPaymentValue()
    {
        $governmentPaymentValue = DB::connection('dpaisa')->select("SELECT SUM(t.amount/100) as totalSum FROM transaction_events as t
                                                                                RIGHT JOIN agents as a ON a.user_id = t.user_id
                                                                                WHERE t.user_id = a.user_id and a.status = 'ACCEPTED'
                                                                                AND
                                                                                (
                                                                                   t.transaction_type ='App\\\Models\\\NchlAggregatedPayment'
                                                                                 )
                                                                                AND
                                                                                date(t.created_at) >= date(:fromDate)
                                                                                AND
                                                                                date(t.created_at) <= date(:toDate)
                                                                                AND
                                                                                (t.amount/100) > :fromAmount and (t.amount/100) <= :toAmount
                                                                               ",['fromDate'=>$this->fromDate,'toDate'=>$this->toDate,'fromAmount'=>$this->fromAmount,'toAmount'=>$this->toAmount]);

        $governmentPaymentValue = $governmentPaymentValue[0]->totalSum;
        return $governmentPaymentValue;
    }

}
