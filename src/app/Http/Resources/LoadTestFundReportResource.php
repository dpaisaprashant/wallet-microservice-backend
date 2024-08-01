<?php

namespace App\Http\Resources;

class LoadTestFundReportResource extends \Illuminate\Http\Resources\Json\JsonResource
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
            'Pre TRANSACTION ID' =>$this->pre_transaction_id,
            'NAME' =>$this->user->name ?? '--',
            'MOBILE NUMBER' => $this->user->mobile_no ?? '--',
            'EMAIL' => $this->user->email ?? '--',
            'AMOUNT' => $this->amount ?? 0,
            'CREATED AT' => (string) $this->created_at
        ];
    }
}
