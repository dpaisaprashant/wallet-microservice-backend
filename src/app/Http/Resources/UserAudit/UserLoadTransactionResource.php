<?php

namespace App\Http\Resources\UserAudit;

use Illuminate\Http\Resources\Json\JsonResource;

class UserLoadTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $date = explode(' ', $this->created_at);

        return [
            'DATE' => (string) $date[0],
            'TIME' => (string) $date[1],
            'DESCRIPTION' => $this->description,
            'VENDOR' => $this->payment_mode ?? '',
            'STATUS' => $this->status,
            'DEBIT' => '',
            'CREDIT' => $this->amount,
            'BALANCE' => $this->current_balance,
        ];
    }
}
