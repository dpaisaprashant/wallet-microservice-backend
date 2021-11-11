<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'GENDER' => $this->gender,
            'EMAIL' => $this->email,
            'BALANCE' => $this->wallet->balance,
            'KYC STATUS' => $this->resource->getKYCStatus(),
            'REGISTERED ON' => (string) $this->created_at,
            /*'TOTAL FUND SEND' => $this->getFundSendAmount(),
            'TOTAL FUND RECEIVE' => $this->getFundReceiveAmount(),
            'TOTAL PAYMENT' => $this->getTotalPaymentAmount(),
            'TOTAL LOADED' => $this->getTotalLoadedAmount(),*/
            'TRANSACTION COUNT' => $this->resource->totalTransactionCount(),
        ];
    }
}
