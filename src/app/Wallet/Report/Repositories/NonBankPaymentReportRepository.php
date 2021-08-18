<?php


namespace App\Wallet\Report\Repositories;


use App\Models\FundRequest;
use App\Models\NchlAggregatedPayment;
use App\Models\NchlBankTransfer;
use App\Models\NchlLoadTransaction;
use App\Models\NICAsiaCyberSourceLoadTransaction;
use App\Models\TransactionEvent;
use App\Models\UsedUserReferral;
use App\Models\UserLoadTransaction;
use App\Models\UserReferralBonusTransaction;
use App\Models\UserToUserFundTransfer;
use App\Models\UserTransaction;
use App\Wallet\Commission\Models\Commission;

class NonBankPaymentReportRepository extends AbstractReportRepository
{

    public function getBillPaymentNumber(){
        $billPaymentTotalNumber = TransactionEvent::whereIn('transaction_type',[UserTransaction::class,NchlAggregatedPayment::class])
            ->filter($this->request)
            ->count();
        return $billPaymentTotalNumber;
    }

    public function getBillPaymentValue(){
        $billPaymentTotalValue = TransactionEvent::whereIn('transaction_type',[UserTransaction::class,NchlAggregatedPayment::class])
            ->filter($this->request)
            ->sum('amount');
        
        return $billPaymentTotalValue;
    }

    public function getTransferNumber(){
        $transferTotalNumber = TransactionEvent::where('transaction_type',UserToUserFundTransfer::class)
            ->where('vendor','Transfer Fund')
            ->filter($this->request)
            ->count();
        $fundTotalRequestNumber = TransactionEvent::where('transaction_type',FundRequest::class)
            ->filter($this->request)
            ->count();
        return $transferTotalNumber + $fundTotalRequestNumber;
    }

    public function getTransferValue(){
        $transferTotalValue = TransactionEvent::where('transaction_type',UserToUserFundTransfer::class)
            ->where('vendor','Transfer Fund')
            ->filter($this->request)
            ->sum('amount');
        $fundTotalRequestValue = TransactionEvent::where('transaction_type',FundRequest::class)
            ->filter($this->request)
            ->sum('amount');
        return $transferTotalValue + $fundTotalRequestValue;
    }

    public function getCashInNumber(){
        $cashInTotalNumber = TransactionEvent::whereIn('transaction_type',[UserLoadTransaction::class,NchlLoadTransaction::class,NICAsiaCyberSourceLoadTransaction::class])
            ->filter($this->request)
            ->count();
        return $cashInTotalNumber;
    }

    public function getCashInValue(){
        $cashInTotalValue = TransactionEvent::whereIn('transaction_type',[UserLoadTransaction::class,NchlLoadTransaction::class,NICAsiaCyberSourceLoadTransaction::class])
            ->filter($this->request)
            ->sum('amount');
        return $cashInTotalValue;
    }

    public function getOfferNumber(){
        $cashBackOfferTotalNumber = TransactionEvent::where('service_type','CASHBACK')->where('transaction_type',Commission::class)
            ->filter($this->request)
            ->count();
        $referralTotalNumber = TransactionEvent::whereIn('transaction_type',[UsedUserReferral::class,UserReferralBonusTransaction::class])
            ->filter($this->request)
            ->count();
        return $cashBackOfferTotalNumber + $referralTotalNumber;
    }

    public function getOfferValue(){
        $cashBackOfferTotalValue = TransactionEvent::where('service_type','CASHBACK')
            ->where('transaction_type',Commission::class)
            ->filter($this->request)
            ->sum('amount');
        $referralTotalValue = TransactionEvent::whereIn('transaction_type',[UsedUserReferral::class,UserReferralBonusTransaction::class])
            ->filter($this->request)
            ->sum('amount');
        return $cashBackOfferTotalValue + $referralTotalValue;
    }

    public function getFeesChargesNumber(){
        $commissionTotalNumber = TransactionEvent::where('service_type','COMMISSION')
            ->where('transaction_type',Commission::class)
            ->filter($this->request)
            ->count();
        return $commissionTotalNumber;
    }

    public function getFeesChargesValue(){
        $commissionTotalValue = TransactionEvent::where('service_type','COMMISSION')->where('transaction_type',Commission::class)
            ->filter($this->request)
            ->sum('amount');
        return $commissionTotalValue;
    }

    public function getCashOutNumber(){
        $cashOutTotalNumber = TransactionEvent::where('transaction_type',NchlBankTransfer::class)
            ->filter($this->request)
            ->count();
        return $cashOutTotalNumber;
    }

    public function getCashOutValue(){
        $cashOutTotalValue = TransactionEvent::where('transaction_type',NchlBankTransfer::class)
            ->filter($this->request)
            ->sum('amount');
        return $cashOutTotalValue;
    }

}
