<?php

namespace App\Http\Resources;

use App\Models\UserRegisteredByUser;

class PreTransactionResource extends \Illuminate\Http\Resources\Json\JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $count = UserRegisteredByUser::with('user','UserWhoRegistered')->where('registered_by_id','=',$this->registered_by_id)->count();

        return [
            'User Number' => optional($this->user)->mobile_no,
            'Pre Transaction ID' => $this->pre_transaction_id,
            'Amount' => $this->amount,
            'Description' => $this->description,
            'Vendor' => $this->vendor,
            'Service Type' => $this->service_type,
            'Micro Service Type' => $this->microservice_type,
            'Transaction Type' => $this->transaction_type,
            'URL' => $this->url,
            'Before Balance' => $this->before_balance,
            'After Balance' => $this->after_balance,
            'Before Bonus Balance' => $this->before_bonus_balance,
            'After Bonus Balance' => $this->after_bonus_balance,
            'Date' => (string) $this->created_at,
            'Status' => $this->status ?? "--",
        ];
    }
}
