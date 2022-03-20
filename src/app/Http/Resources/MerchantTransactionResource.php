<?php

namespace App\Http\Resources;

use App\Models\UserRegisteredByUser;

class MerchantTransactionResource extends \Illuminate\Http\Resources\Json\JsonResource
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
            'UID' => optional($this->transactions)->uid ?? '---',
            'Transaction ID' => $this->transaction_id,
            'Pre Transaction ID' => optional($this->transactions)->pre_transaction_id,
            'Merchant' => optional($this->merchant)->mobile_no,
            'User' => optional($this->user)->mobile_no,
            'Description' => $this->description,
            'Amount' => $this->amount ?? 0,
            'Date' => (string) $this->created_at,
        ];
    }
}
