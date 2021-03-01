<?php

namespace App\Http\Resources\DPaisaAudit;

use Illuminate\Http\Resources\Json\JsonResource;

class PayPointResource extends JsonResource
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
            'DATE' => (string) $this->created_at,
            'DESCRIPTION' => 'PAYPOINT',
            'VENDOR' => $this->userTransaction['vendor'] ?? '',
            'STATUS' => $this->getStatus(),
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
