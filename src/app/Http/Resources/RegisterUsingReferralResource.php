<?php

namespace App\Http\Resources;

use App\Models\TransactionEvent;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class RegisterUsingReferralResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (optional($this->registerReferral())->status == 'COMPLETE'){
            $referral_from_earnings = optional($this->registerReferral())->referred_from_amount;
        }else{
            $referral_from_earnings = 0;
        }

        if (empty($this->kyc)){
            $kyc_status = "no filled";
        }elseif($this->kyc->accept === null){
            $kyc_status = "not verified";
        }elseif($this->kyc->accept === 0){
            $kyc_status = "kyc rejected";
        }elseif($this->kyc->accept == 1){
            $kyc_status = "verified";
        }

        return [
            'Referred From' => optional($this->referredByUser())->name,
            'Referred From Earnings' => 'Rs: '. $referral_from_earnings,
            'User Name' => $this->name,
            'Mobile No.' => $this->mobile_no,
            'KYC Status' => $kyc_status,
            'Transaction Count' => $this->totalTransactionCount(),
            'Total Balance' => $this->wallet->balance / 100,
            'Total Referral Amount' => $this->totalReferralAmount(),
            'Date' => (string) $this->created_at
        ];
    }
}
