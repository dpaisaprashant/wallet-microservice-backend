<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserLoadTransactionResource extends JsonResource
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
            'PROCESS ID' => $this->process_id,
            'PAYMENT MODE' => $this->payment_mode,
            'USER' => $this->user->name,
            'USER NUMBER' => $this->user->mobile_no,
            'DESCRIPTION' => $this->description,
            'PRIVATE IP' => $this->private_ip,
            'AMOUNT' => $this->amount,
            'TRANSACTION FEE' => $this->transaction_fee ?? 0,
            'GATEWAY REF NO' => $this->gateway_ref_no,
            'STATUS' => $this->status,
            'CREATED AT' => (string) $this->created_at
        ];
    }
}
