<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NchlBankTransferResource extends JsonResource
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
            'TRANSACTION ID' => $this->transaction_id,
            'PRE-TRANSACTION ID' => $this->pre_transaction_id,
            'REQUEST ID' => $this->request_id,
            'BANK' =>$this->bank,
            'USER' => optional(optional($this->preTransaction)->user)->name,
            'USER NUMBER' => optional(optional($this->preTransaction)->user)->mobile_no,
            'AMOUNT' => $this->amount ?? 0,
            'COMMISSION AMOUNT' => (($this->commission->before_amount ?? 0) -  ($this->commission->after_account??0)) ?? 0,
            'DEBIT RESPONSE MESSAGE' => $this->debit_response_message,
            'CREDIT RESPONSE MESSAGE' => $this->credit_response_message,
            'CREATED AT' => (string) $this->created_at
        ];
    }
}
