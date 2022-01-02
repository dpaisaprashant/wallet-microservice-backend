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

class StatementSettlementBankRepository extends AbstractReportRepository
{
    protected $date;

    public function __construct(Request $request)
    {
        parent::__construct($request);
            $this->date = date('Y-m-d', strtotime(str_replace(',', ' ', $request->from)));
    }


    public function checkForReport(){
        return DB::connection('clearance')->table('statement_settlement_banks')->where('date', $this->date)->first();
    }


    public function getCreditByTitle($id, $title)
    {
        $title = DB::connection('clearance')->table('statement_sums')
            ->where('statement_settlement_id', $id)
            ->where('title', $title)
            ->first();
        if($title){
            return $title->amount;
        }else{
            return 0;
        }

    }

}
