<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoadTestFundResource extends JsonResource
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
            'ADMIN' => $this->admin_id,
            'UID' => $this->uid,
            'PRE TRANSACTION ID' => $this->pre_transaction_id,
            'USER' => $this->user['mobile_no'],
            'DESCRIPTION' => $this->description,
            'AMOUNT' => $this->amount,
            'DATE' => (string) $this->created_at,
        ];
    }
}
