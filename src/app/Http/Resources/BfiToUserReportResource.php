<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BfiToUserReportResource extends JsonResource
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
            'BFI USER' => optional($this->bfiUser)->bfi_name,
            'BFI ID' => $this->bfi_id,
            'TRANSACTION ID' =>$this->transaction_id ,
            'PROCESS ID' => $this->process_id,
            'WALLET ID' => $this->wallet_id,
            'AMOUNT' => $this->amount ?? 0,
            'PURPOSE' => $this->purpose,
            'TRANSACTION DETAIL' => $this->transaction_detail,
            'STATUS' => $this->status,
            'FROM PRE-TRANSACTION ID' => $this->from_pre_transaction_id,
            'TO PRE-TRANSACTION ID' => $this->to_pre_transaction_id ,
            'CREATED AT' => (string) $this->created_at
        ];
    }
}
