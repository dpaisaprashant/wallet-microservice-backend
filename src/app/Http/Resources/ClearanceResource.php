<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClearanceResource extends JsonResource
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
            'CLEARED DATE' => (string) $this->created_at,
            'TRANSACTION DATE' => (string) $this->transaction_date,
            'CLEARED BY' => $this->admin->name,
            'STATUS' => $this->getStatus(),
            'TRANSACTIONS COUNT' => $this->total_transaction_count,
            'TRANSACTIONS AMOUNT' => $this->total_transaction_amount,
            'CLEARANCE TYPE' => $this->clearance_type
        ];
    }
}
