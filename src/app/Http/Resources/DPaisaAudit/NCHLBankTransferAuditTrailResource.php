<?php

namespace App\Http\Resources\DPaisaAudit;

use Illuminate\Http\Resources\Json\JsonResource;

class NCHLBankTransferAuditTrailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        if (strtoupper($this->credit_response_message) == 'SUCCESS'){
            $status = "SUCCESS";
        }elseif(strtoupper($this->credit_response_message) == 'ERROR'){
            $status = "ERROR";
        }elseif(empty($this->credit_response_message)){
            $status = "---";
        }else{
            $status = $this->credit_response_message;
        }

        return [
            'DATE' => (string) $this->created_at,
            'DESCRIPTION' => 'NCHL BANK TRANSFER',
            'VENDOR' => $this->userTransaction['vendor'] ?? '',
            'Transaction Id' => $this->transaction_id,
            'STATUS' => $status,
            'VENDOR COMMISSION' => $this->vendor_commission ?? 0,
            'USER COMMISSION' => $this->user_commission ?? 0,
            'CASH BACK' => $this->user_cashback ?? 0,
            'AMOUNT' => $this->userTransaction->amount ?? '',
            'DEBIT' => $this->debit ?? 0,
            'CREDIT' => $this->credit ?? 0,
            'BALANCE' => $this->balance
        ];
    }
}
