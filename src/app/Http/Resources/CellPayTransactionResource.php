<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CellPayTransactionResource extends JsonResource
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
            'ACCOUNT' => $this->account,
            'USER NAME' => optional(optional($this->preTransaction)->user)->name,
            'USER NUMBER' => optional(optional($this->preTransaction)->user)->mobile_no,
            'AMOUNT' => $this->amount,
            'DESCRIPTION' => $this->description,
            'REFERENCE NO' => $this->reference_no,
            'VENDOR' => $this->vendor,
            'SERVICE TYPE' => $this->service_type,
            'TRANSACTION ID' => $this->transaction_id,
            'TRANSACTION TYPE ID' => $this->trasfer_type_id,
            'STATUS'=>$this->status,
            'CREATED AT' => (string) $this->created_at
        ];
    }
}
