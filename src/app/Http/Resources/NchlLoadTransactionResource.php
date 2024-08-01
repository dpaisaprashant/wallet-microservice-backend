<?php

namespace App\Http\Resources;

use App\Models\UserRegisteredByUser;

class NchlLoadTransactionResource extends \Illuminate\Http\Resources\Json\JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        if ($this->commission){
            $commission = $this->commission->before_amount - $this->commission->after_amount;
        }else{
            $commission = 0;
        }

        return [
            'Pre Transaction ID' => $this->pre_transaction_id,
            'Transaction ID' => $this->transaction_id,
            'Reference ID' => $this->reference_id,
            'User' => optional($this->user)->mobile_no,
            'Bank' => "Connect IPS",
            'Description' => $this->remark,
            'Amount' => $this->amount ?? 0,
            'Commission' => "Rs. " . $commission,
            'Status' => $this->status,
            'Date' => (string) $this->updated_at,
        ];
    }
}
