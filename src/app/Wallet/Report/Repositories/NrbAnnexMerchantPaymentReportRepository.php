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

class NrbAnnexMerchantPaymentReportRepository extends AbstractReportRepository
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
    }

    public function getSuccessfulMerchantPaymentCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                            WHERE
                                                                            service_type='MERCHANT'  AND status = 'SUCCESS'
                                                                            AND
                                                                            date(created_at) >= date('$this->fromDate')
                                                                            AND
                                                                            date(created_at) <= date('$this->toDate')
                                                                               ");
        $count = $count[0]->totalCount;
        return $count;
    }

    public function getFailedMerchantPaymentCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                            WHERE
                                                                            service_type='MERCHANT'  AND status != 'SUCCESS'
                                                                            AND
                                                                            date(created_at) >= date('$this->fromDate')
                                                                            AND
                                                                            date(created_at) <= date('$this->toDate')
                                                                               ");
        $count = $count[0]->totalCount;
        return $count;
    }

    public function getSuccessfulLoadFundsCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                            WHERE
                                                                            ((service_type='NIC_ASIA_LOAD' AND status = 'SUCCESS')
                                                                            OR
                                                                            (service_type='NCHL_LOAD' AND status = 'SUCCESS')
                                                                            OR
                                                                            (service_type='NPAY_LOAD' AND status = 'SUCCESS')
                                                                            OR
                                                                            (service_type='NPS_LOAD' AND status = 'SUCCESS'))
                                                                            AND
                                                                            date(created_at) >= date('$this->fromDate')
                                                                            AND
                                                                            date(created_at) <= date('$this->toDate')
                                                                               ");
        $count = $count[0]->totalCount;
        return $count;
    }

    public function getFailedLoadFundsCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                            WHERE
                                                                            ((service_type='NIC_ASIA_LOAD' AND status != 'SUCCESS')
                                                                            OR
                                                                            (service_type='NCHL_LOAD' AND status != 'SUCCESS')
                                                                            OR
                                                                            (service_type='NPAY_LOAD' AND status != 'SUCCESS')
                                                                            OR
                                                                            (service_type='NPS_LOAD' AND status != 'SUCCESS'))
                                                                            AND
                                                                            date(created_at) >= date('$this->fromDate')
                                                                            AND
                                                                            date(created_at) <= date('$this->toDate')
                                                                               ");
        $count = $count[0]->totalCount;
        return $count;
    }

    public function getSuccessfulBankTransferCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                            WHERE
                                                                            service_type='BANK_TRANSFER'  AND status = 'SUCCESS'
                                                                            AND
                                                                            date(created_at) >= date('$this->fromDate')
                                                                            AND
                                                                            date(created_at) <= date('$this->toDate')
                                                                               ");
        $count = $count[0]->totalCount;
        return $count;

    }

    public function getFailedBankTransferCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                            WHERE
                                                                            service_type='BANK_TRANSFER'  AND status != 'SUCCESS'
                                                                            AND
                                                                            date(created_at) >= date('$this->fromDate')
                                                                            AND
                                                                            date(created_at) <= date('$this->toDate')
                                                                               ");
        $count = $count[0]->totalCount;
        return $count;
    }

    public function getSuccessfulNchlAggregatedCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                            WHERE
                                                                            service_type='NCHL_AGGREGATED_PAYMENTS'  AND status = 'SUCCESS'
                                                                            AND
                                                                            date(created_at) >= date('$this->fromDate')
                                                                            AND
                                                                            date(created_at) <= date('$this->toDate')
                                                                               ");
        $count = $count[0]->totalCount;
        return $count;
    }

    public function getFailedNchlAggregatedCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                            WHERE
                                                                            service_type='NCHL_AGGREGATED_PAYMENTS'  AND status != 'SUCCESS'
                                                                            AND
                                                                            date(created_at) >= date('$this->fromDate')
                                                                            AND
                                                                            date(created_at) <= date('$this->toDate')
                                                                               ");
        $count = $count[0]->totalCount;
        return $count;
    }

    public function getSuccessfulPaypointCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                            WHERE
                                                                            ((service_type='' AND status = 'SUCCESS')
                                                                            OR
                                                                            (service_type='internet' AND status = 'SUCCESS')
                                                                            OR
                                                                            (service_type='tv' AND status = 'SUCCESS'))
                                                                            AND
                                                                            date(created_at) >= date('$this->fromDate')
                                                                            AND
                                                                            date(created_at) <= date('$this->toDate')
                                                                               ");
        $count = $count[0]->totalCount;
        return $count;
    }

    public function getFailedPaypointCount()
    {
        $count = DB::connection('dpaisa')->select("SELECT COUNT(*) as totalCount FROM  `pre_transactions`
                                                                            WHERE
                                                                            ((service_type='' AND status != 'SUCCESS')
                                                                            OR
                                                                            (service_type='internet' AND status != 'SUCCESS')
                                                                            OR
                                                                            (service_type='tv' AND status != 'SUCCESS'))
                                                                            AND
                                                                            date(created_at) >= date('$this->fromDate')
                                                                            AND
                                                                            date(created_at) <= date('$this->toDate')
                                                                               ");
        $count = $count[0]->totalCount;
        return $count;
    }

    public function getSuccessfulAgentReceivedFundsCount()
    {

    }

    public function getFailedAgentReceivedFundsCount()
    {

    }

    public function getSuccessfulAgentTransferFundsCount()
    {

    }

    public function getFailedAgentTransferFundsCount()
    {

    }

}
