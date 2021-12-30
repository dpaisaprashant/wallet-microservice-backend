<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NICAsiaCyberSourceLoadTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'REFERENCE NUMBER' => $this->reference_number,
            'PRE-TRANSACTION ID' => $this->pre_transaction_id,
            'TRANSACTION ID' => $this->transaction_uuid,
            'USER' => optional(optional($this->preTransaction)->user)->name,
            'USER NUMBER' => optional(optional($this->preTransaction)->user)->mobile_no,
            'CURRENCY' => $this->currency,
            'AMOUNT' => $this->amount,
            'STATUS' => $this->status,
            'REASON CODE' => $this->reason_code,
            'SIGNED DATE/TIME' => $this->signed_datetime,
            'RESPONSE DATE/TIME' => $this->response_datetime,
            'CREATED AT' => (string) $this->created_at
        ];
    }
}
