<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KhaltiResource extends JsonResource
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
            'REFERENCE NUMBER' => $this->reference_no,
            'ACCOUNT' => $this->account,
            'AMOUNT' => $this->amount,
            'MESSAGE' => $this->message,
            'SERVICE' =>$this->service,
            'USER' => optional(optional($this->preTransaction)->user)->name,
            'USER NUMBER' => optional(optional($this->preTransaction)->user)->mobile_no,
            'VENDOR' => $this->vendor,
            'STATUS' => $this->status,
            'CREATED AT' => (string) $this->created_at
        ];
    }
}



