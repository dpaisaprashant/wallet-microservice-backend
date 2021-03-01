<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionEventResource extends JsonResource
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
            'USER TRANSACTION ID' => $this->uid ?? '---',
            'USER' => $this->user->name,
            'USER CONTACT NO.' => $this->user->mobile_no,
            'USER EMAIL' => $this->user->email,
            'ACCOUNT' => $this->account,
            'AMOUNT' => $this->amount,
            'VENDOR' => $this->vendor,
            'SERVICE TYPE' => $this->service_type,
            'DESCRIPTION' => $this->description,
            'CREATED AT' => $this->created_at
        ];
    }
}
