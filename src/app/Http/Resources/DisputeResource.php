<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DisputeResource extends JsonResource
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
            'DISPUTE CREATED BY' => $this->admin->email,
            'TRANSACTION ID' => $this->disputeable->refStan ?? $this->disputeable->transaction_id,
            'TRANSACTION DATE' => (string) $this->disputeable->created_at,
            'TRANSACTION USER' => $this->disputeable->user->name,
            'TRANSACTION USER NO.' => $this->disputeable->user->mobile_no,
            'TRANSACTION AMOUNT' => $this->disputeable->amount,
            'DISPUTED DATE' => (string) $this->created_at,
            'VENDOR TYPE' => $this->vendor_type,
            'DISPUTE TYPE' => $this->dispute_type,
            'VENDOR STATUS' => $this->vendor_status,
            'VENDOR AMOUNT' => $this->vendor_amount,
            'USER STATUS' => $this->user_status,
            'USER AMOUNT' => $this->user_amount,
            'ERROR SOURCE' => $this->source,
            'HANDLER' => $this->handler,
            'USER DISPUTE STATUS' => $this->user_dispute_status,
            'CLEARANCE DISPUTE STATUS' => $this->clearance_dispute_status,
            //'CLEARED DATE' => $this->disputeHandler ? (string) $this->disputeHandler->clearedClearance['created_at'] : 'Not Cleared'
        ];
    }
}
