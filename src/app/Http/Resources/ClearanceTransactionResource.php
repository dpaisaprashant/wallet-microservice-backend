<?php

namespace App\Http\Resources;

use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use Illuminate\Http\Resources\Json\JsonResource;

class ClearanceTransactionResource extends JsonResource
{

    private function transactionTypeResolver()
    {
        $type = 'not available';
        if ($this->transaction_type == UserTransaction::class) {
            $type = 'PAYPOINT';
        } elseif ($this->transaction_type == UserLoadTransaction::class) {
            $type = 'NPAY';
        }
        return $type;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'TRANSACTION ID' => $this->clearanceable->refStan ?? $this->clearanceable->transaction_id,
            'TRANSACTION DATE' => (string) $this->clearanceable->created_at,
            'TRANSACTION USER' => $this->clearanceable->user->name,
            'TRANSACTION USER NO.' => $this->clearanceable->user->mobile_no,
            'AMOUNT' => $this->clearanceable->amount,
            'CLEARANCE DATE' => (string) $this->clearances->created_at,
            'DISPUTE STATUS' => $this->getDisputeStatus(),
            'TRANSACTION TYPE' => $this->transactionTypeResolver(),
            'VENDOR' => $this->clearanceable->payment_mode ?? $this->clearanceable->vendor
        ];
    }
}
