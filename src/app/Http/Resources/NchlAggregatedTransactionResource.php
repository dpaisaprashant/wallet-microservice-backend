<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NchlAggregatedTransactionResource extends JsonResource
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
            'SERVICE TYPE' => $this->service_type,
            'USER' => optional(optional($this->preTransaction)->user)->name,
            'USER NUMBER' => optional(optional($this->preTransaction)->user)->mobile_no,
            'AMOUNT' => $this->amount,
            'TRANSACTION FEE' => $this->transaction_fee ?? 0,
            'RESPONSE ID' => $this->response_id,
            'REF ID' => $this->ref_id,
            'DEBIT STATUS' => $this->debit_status,
            'CREDIT STATUS' => $this->credit_status,
            'RESPONSE CODE' => $this->response_code,
            'RESPONSE DESCRIPTION' => $this->response_description,
            'CHECK RESPONSE CODE' => $this->check_response_code,
            'CHECK RESPONSE DESCRIPTION' => $this->check_response_description,
            'CREATED AT' => (string) $this->created_at
        ];
    }
}
