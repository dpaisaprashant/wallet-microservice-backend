<?php

namespace App\Http\Resources\DPaisaAudit;

use Illuminate\Http\Resources\Json\JsonResource;

class NchlLoadTransactionAuditTrailResource extends JsonResource
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
        }elseif(empty($this->credit_response_message)){
            $status = "Not Completed";
        }else{
            $status = $this->credit_response_message;
        }

        return [
            'DATE' => (string) $this->created_at,
            'DESCRIPTION' => $this->remark,
            'VENDOR' => 'Connect IPS',
            'Transaction Id' => $this->transaction_id,
            'STATUS' => $status,
            'VENDOR COMMISSION' => $this->vendor_commission ?? 0,
            'USER COMMISSION' => $this->user_commission ?? 0,
            'CASH BACK' => $this->user_cashback ?? 0,
            'AMOUNT' => $this->userTransaction->amount ?? '',
            'DEBIT' => $this->debit ?? 0,
            'CREDIT' => $this->credit ?? 0,
            'BALANCE' => $this->balance,
        ];

    }
}
