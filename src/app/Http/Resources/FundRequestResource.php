<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FundRequestResource extends JsonResource
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
            'FROM USER' => $this->fromUser->name,
            'FROM USER NO.' => $this->fromUser->mobile_no,
            'TO USER' => $this->toUser->name,
            'TO USER NO.' => $this->toUser->mobile_no,
            'AMOUNT' => $this->amount,
            'REQUEST STATUS' => $this->requestStatus(),
            'RESPONSE STATUS' => $this->responseStatus(),
            'REQUESTED DATE' => (string) $this->created_at,
            'RESPONSE DATE' => (string) $this->updates_at
        ];
    }
}
