<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MerchantResource extends JsonResource
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
            'NAME' => $this->name,
            'MOBILE' => $this->mobile_no,
            'PRIZE CODE' => optional($this->prizeCode)->code,
            'GENDER' => $this->gender,
            'EMAIL' => $this->email,
            'BALANCE' => $this->wallet->balance,
            'KYC STATUS' => $this->resource->getKYCStatus(),
            'MERCHANT TYPE' => $this->merchant->merchantType->name ?? "--",
            'REGISTERED ON' => (string) $this->created_at,
            'TRANSACTION COUNT' => $this->resource->totalTransactionCount(),
        ];
    }
}
