<?php


namespace App\Wallet\Report\Repositories;


use App\Models\PaymentNepalLoadTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class NrbAnnexMerchantPaymentReportRepository extends AbstractReportRepository
{
    protected $fromDate;
    protected $fromAmount;
//    protected $toDate;
//    protected $toAmount;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->fromDate = date('Y-m-d', strtotime(str_replace(',', ' ', $request->from)));
        $this->toDate = date('Y-m-d', strtotime(str_replace(',', ' ', $request->to)));
    }


    public function getSuccessfulMerchantPaymentCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM `pre_transactions` WHERE status='SUCCESS' AND (microservice_type='KHALTI' OR microservice_type='NTC' OR vendor='PAYPOINT' OR vendor='CELLPAY' OR vendor='NEA') AND id NOT IN (SELECT id FROM  `pre_transactions`
                                                                               WHERE (microservice_type='KHALTI' OR microservice_type='NTC' OR vendor='PAYPOINT' OR vendor='CELLPAY' OR vendor='NEA') AND
                                                                            ((service_type='NTC_PREPAID')
                                                                                OR
                                                                             (service_type='NTC_POSTPAID')
                                                                                OR
                                                                             (service_type='NTC_DATA')
                                                                                OR
                                                                             (service_type='NTC_EPIN')
                                                                                OR
                                                                             (service_type='NCELL')
                                                                                OR
                                                                             (service_type='NCELL_DATA_PACK')
                                                                                OR
                                                                             (service_type='NCELL_EPIN')
                                                                                OR
                                                                             (service_type='SMARTCELL_TOPUP')
                                                                                OR
                                                                             (service_type='SMARTCELL_EPIN')
                                                                                OR
                                                                             (company_code=78 AND service_code=0)
                                                                                OR
                                                                             (company_code=585 AND service_code=0)
                                                                                OR
                                                                             (company_code=585 AND service_code=1)
                                                                                OR
                                                                             (company_code=585 AND service_code=5)
                                                                                OR
                                                                             (company_code=709)
                                                                                OR
                                                                             (company_code=582)
                                                                                OR
                                                                             ( company_code=588)
                                                                                OR
                                                                             (company_code=587))
                                                                            AND
                                                                            date(created_at) >= date(:fromDate)
                                                                            AND
                                                                            date(created_at) <= date(:toDate))
                                                                            AND
                                                                            date(created_at) >= date(:from)
                                                                            AND
                                                                            date(created_at) <= date(:to)
                                                                               ", ['fromDate' => $this->fromDate, 'toDate' => $this->toDate,'from' => $this->fromDate, 'to' => $this->toDate]);
        $count = $count[0]->totalCount;
        return $count;
    }

    public function getFailedMerchantPaymentCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM `pre_transactions` WHERE status!='SUCCESS' AND (microservice_type='KHALTI' OR microservice_type='NTC' OR vendor='PAYPOINT' OR vendor='CELLPAY' OR vendor='NEA') AND id NOT IN (SELECT id FROM  `pre_transactions`
                                                                               WHERE (microservice_type='KHALTI' OR microservice_type='NTC' OR vendor='PAYPOINT' OR vendor='CELLPAY' OR vendor='NEA') AND
                                                                            ((service_type='NTC_PREPAID')
                                                                                OR
                                                                             (service_type='NTC_POSTPAID')
                                                                                OR
                                                                             (service_type='NTC_DATA')
                                                                                OR
                                                                             (service_type='NTC_EPIN')
                                                                                OR
                                                                             (service_type='NCELL')
                                                                                OR
                                                                             (service_type='NCELL_DATA_PACK')
                                                                                OR
                                                                             (service_type='NCELL_EPIN')
                                                                                OR
                                                                             (service_type='SMARTCELL_TOPUP')
                                                                                OR
                                                                             (service_type='SMARTCELL_EPIN')
                                                                                OR
                                                                             (company_code=78 AND service_code=0)
                                                                                OR
                                                                             (company_code=585 AND service_code=0)
                                                                                OR
                                                                             (company_code=585 AND service_code=1)
                                                                                OR
                                                                             (company_code=585 AND service_code=5)
                                                                                OR
                                                                             (company_code=709)
                                                                                OR
                                                                             (company_code=582)
                                                                                OR
                                                                             ( company_code=588)
                                                                                OR
                                                                             (company_code=587))
                                                                            AND
                                                                            date(created_at) >= date(:fromDate)
                                                                            AND
                                                                            date(created_at) <= date(:toDate))
                                                                            AND
                                                                            date(created_at) >= date(:from)
                                                                            AND
                                                                            date(created_at) <= date(:to)
                                                                               ", ['fromDate' => $this->fromDate, 'toDate' => $this->toDate,'from' => $this->fromDate, 'to' => $this->toDate]);
        $count = $count[0]->totalCount;
        return $count;
    }

    public function getSuccessfulLoadFundsCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                            WHERE
                                                                            ((service_type='FUND_TRANSFER' AND status = 'SUCCESS')
                                                                            OR
                                                                            (service_type='FUND_REQUEST' AND status = 'SUCCESS'))
                                                                            AND
                                                                            date(created_at) >= date(:from)
                                                                            AND
                                                                            date(created_at) <= date(:to)",
            ['from' => $this->fromDate, 'to' => $this->toDate]);
        $count = $count[0]->totalCount;
        return $count;
    }

    public function getFailedLoadFundsCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                            WHERE
                                                                            ((service_type='FUND_TRANSFER' AND status != 'SUCCESS')
                                                                            OR
                                                                            (service_type='FUND_TRANSFER' AND status != 'SUCCESS'))
                                                                            AND
                                                                            date(created_at) >= date(:from)
                                                                            AND
                                                                            date(created_at) <= date(:to)"
            , ['from' => $this->fromDate, 'to' => $this->toDate]);
        $count = $count[0]->totalCount;
        return $count;
    }

    public function getSuccessfulBankTransferCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                            WHERE
                                                                            service_type='BANK_TRANSFER'  AND status = 'SUCCESS'
                                                                            AND
                                                                            date(created_at) >= date(:fromDate)
                                                                            AND
                                                                            date(created_at) <= date(:toDate)
                                                                               ", ['fromDate' => $this->fromDate, 'toDate' => $this->toDate]);
        $count = $count[0]->totalCount;
        return $count;

    }

    public function getFailedBankTransferCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                            WHERE
                                                                            service_type='BANK_TRANSFER'  AND status != 'SUCCESS'
                                                                            AND
                                                                            date(created_at) >= date(:fromDate)
                                                                            AND
                                                                            date(created_at) <= date(:toDate)
                                                                               ", ['fromDate' => $this->fromDate, 'toDate' => $this->toDate]);
        $count = $count[0]->totalCount;
        return $count;
    }

    public function getSuccessfulNchlAggregatedCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                            WHERE
                                                                            (microservice_type='NCHL' AND (service_type='' OR service_type='NCHL_AGGREGATED_PAYMENTS'))  AND status = 'SUCCESS'

                                                                            AND
                                                                            date(created_at) >= date(:fromDate)
                                                                            AND
                                                                            date(created_at) <= date(:toDate)
                                                                               ", ['fromDate' => $this->fromDate, 'toDate' => $this->toDate]);
        $count = $count[0]->totalCount;
        return $count;
    }

    public function getFailedNchlAggregatedCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                            WHERE
                                                                            (microservice_type='NCHL' AND (service_type='' OR service_type='NCHL_AGGREGATED_PAYMENTS'))  AND status != 'SUCCESS'
                                                                            AND
                                                                            date(created_at) >= date(:fromDate)
                                                                            AND
                                                                            date(created_at) <= date(:toDate)
                                                                               ", ['fromDate' => $this->fromDate, 'toDate' => $this->toDate]);
        $count = $count[0]->totalCount;
        return $count;
    }

    public function getSuccessfulPaypointCount()
    {
//        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `transaction_events`
//                                                                            WHERE
//                                                                            ((vendor='NCELL' and service_type='PAYMENT')
//                                                                                OR
//                                                                             (vendor='NCELL' and service_type='DATA-PACK')
//                                                                                OR
//                                                                             (vendor='NTC' and service_type='TOPUP')
//                                                                                OR
//                                                                             (vendor='NTC' and service_type='PREPAID')
//                                                                                OR
//                                                                             (vendor='NTC' and service_type='POSTPAID')
//                                                                                OR
//                                                                             (vendor='UTL' and service_type='PAYMENT')
//                                                                                OR
//                                                                             (vendor='SMARTCELL' and service_type='TOPUP'))
//                                                                            AND
//                                                                            date(created_at) >= date(:fromDate)
//                                                                            AND
//                                                                            date(created_at) <= date(:toDate)
//                                                                               ", ['fromDate' => $this->fromDate, 'toDate' => $this->toDate]);


        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                               WHERE (microservice_type='KHALTI' OR microservice_type='NTC' OR vendor='PAYPOINT') AND status='SUCCESS' AND
                                                                            ((service_type='NTC_PREPAID')
                                                                                OR
                                                                             (service_type='NTC_POSTPAID')
                                                                                OR
                                                                             (service_type='NTC_DATA')
                                                                                OR
                                                                             (service_type='NTC_EPIN')
                                                                                OR
                                                                             (service_type='NCELL')
                                                                                OR
                                                                             (service_type='NCELL_DATA_PACK')
                                                                                OR
                                                                             (service_type='NCELL_EPIN')
                                                                                OR
                                                                             (service_type='SMARTCELL_TOPUP')
                                                                                OR
                                                                             (service_type='SMARTCELL_EPIN')
                                                                                OR
                                                                             (company_code=78 AND service_code=0)
                                                                                OR
                                                                             (company_code=585 AND service_code=0)
                                                                                OR
                                                                             (company_code=585 AND service_code=1)
                                                                                OR
                                                                             (company_code=585 AND service_code=5)
                                                                                OR
                                                                             (company_code=709)
                                                                                OR
                                                                             (company_code=582)
                                                                                OR
                                                                             ( company_code=588)
                                                                                OR
                                                                             (company_code=587))
                                                                            AND
                                                                            date(created_at) >= date(:fromDate)
                                                                            AND
                                                                            date(created_at) <= date(:toDate)
                                                                               ", ['fromDate' => $this->fromDate, 'toDate' => $this->toDate]);
        $count = $count[0]->totalCount;
        return $count;
    }

    public function getFailedPaypointCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                               WHERE (microservice_type='KHALTI' OR microservice_type='NTC' OR vendor='PAYPOINT') AND status!='SUCCESS' AND
                                                                            ((service_type='NTC_PREPAID')
                                                                                OR
                                                                             (service_type='NTC_POSTPAID')
                                                                                OR
                                                                             (service_type='NTC_DATA')
                                                                                OR
                                                                             (service_type='NTC_EPIN')
                                                                                OR
                                                                             (service_type='NCELL')
                                                                                OR
                                                                             (service_type='NCELL_DATA_PACK')
                                                                                OR
                                                                             (service_type='NCELL_EPIN')
                                                                                OR
                                                                             (service_type='SMARTCELL_TOPUP')
                                                                                OR
                                                                             (service_type='SMARTCELL_EPIN')
                                                                                OR
                                                                             (company_code=78 AND service_code=0)
                                                                                OR
                                                                             (company_code=585 AND service_code=0)
                                                                                OR
                                                                             (company_code=585 AND service_code=1)
                                                                                OR
                                                                             (company_code=585 AND service_code=5)
                                                                                OR
                                                                             (company_code=709)
                                                                                OR
                                                                             (company_code=582)
                                                                                OR
                                                                             ( company_code=588)
                                                                                OR
                                                                             (company_code=587))
                                                                            AND
                                                                            date(created_at) >= date(:fromDate)
                                                                            AND
                                                                            date(created_at) <= date(:toDate)
                                                                               ", ['fromDate' => $this->fromDate, 'toDate' => $this->toDate]);
        $count = $count[0]->totalCount;
        return $count;
    }

    public function getSuccessfulCashInCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                            WHERE
                                                                           ((service_type='NPS_LOAD'  AND status = 'SUCCESS')
                                                                            OR
                                                                            (service_type='NCHL_LOAD'  AND status = 'SUCCESS')
                                                                            OR
                                                                            (service_type='NIC_ASIA_LOAD'  AND status = 'SUCCESS')
                                                                            OR
                                                                            (service_type='NPAY_LOAD'  AND status = 'SUCCESS')
                                                                            OR
                                                                            (service_type='NPS_ACCOUNT_LINK_LOAD'  AND status = 'SUCCESS')
                                                                            OR
                                                                            (service_type='PAYMENT_NEPAL_LOAD'  AND status = 'SUCCESS')
                                                                            OR
                                                                            (service_type='BFI_LOAD'  AND status = 'SUCCESS'))
                                                                            AND
                                                                            date(created_at) >= date(:fromDate)
                                                                            AND
                                                                            date(created_at) <= date(:toDate)
                                                                               ", ['fromDate' => $this->fromDate, 'toDate' => $this->toDate]);
        $count = $count[0]->totalCount;
        return $count;

    }

    public function getFailedCashInCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                            WHERE
                                                                            ((service_type='NPS_LOAD'  AND status != 'SUCCESS')
                                                                            OR
                                                                            (service_type='NCHL_LOAD'  AND status != 'SUCCESS')
                                                                            OR
                                                                            (service_type='NIC_ASIA_LOAD'  AND status != 'SUCCESS')
                                                                            OR
                                                                            (service_type='NPAY_LOAD'  AND status != 'SUCCESS')
                                                                            OR
                                                                            (service_type='NPS_ACCOUNT_LINK_LOAD'  AND status != 'SUCCESS')
                                                                            OR
                                                                            (service_type='PAYMENT_NEPAL_LOAD'  AND status != 'SUCCESS')
                                                                            OR
                                                                            (service_type='BFI_LOAD'  AND status != 'SUCCESS'))
                                                                            AND
                                                                            date(created_at) >= date(:fromDate)
                                                                            AND
                                                                            date(created_at) <= date(:toDate)
                                                                               ", ['fromDate' => $this->fromDate, 'toDate' => $this->toDate]);
        $count = $count[0]->totalCount;
        return $count;

    }

    public function getSuccessfulCashOutCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(DISTINCT(to_user)) as totalCount FROM user_to_user_fund_transfers
                                                                WHERE to_user IN (SELECT user_id FROM `agents` where status='ACCEPTED')
                                                                            AND
                                                                            date(created_at) >= date(:fromDate)
                                                                            AND
                                                                            date(created_at) <= date(:toDate)
                                                                               ", ['fromDate' => $this->fromDate, 'toDate' => $this->toDate]);
        $count = $count[0]->totalCount;
        return $count;

    }

    public function getFailedCashOutCount()
    {
//user to agent
//        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
//                                                                            WHERE
//                                                                            service_type='BANK_TRANSFER'  AND status != 'SUCCESS'
//                                                                            AND
//                                                                            date(created_at) >= date(:fromDate)
//                                                                            AND
//                                                                            date(created_at) <= date(:toDate)
//                                                                               ", ['fromDate' => $this->fromDate, 'toDate' => $this->toDate]);
//        $count = $count[0]->totalCount;
        return 0;

    }

}
