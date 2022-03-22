<?php

namespace App\Http\Resources;

use App\Models\TransactionEvent;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

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
        try {
            $transactionId = null;
            $transaction = $this->resource;
            $transaction->load(['transactionable']);
            if(!empty($transaction->transactionable->transaction_id)) {
                $transactionId = $transaction->transactionable->transaction_id;
            } elseif(!empty($transaction->transactionable->refStan)) {
                $transactionId = $transaction->transactionable->refStan;
            } else {
                $transactionId = $transaction->id;
            }
        }catch (\Exception $e) {
            Log::info("transaction id excel exception");
            Log::info($e);
            $transactionId = null;
        }

        return [
            'USER TRANSACTION ID' => $this->uid ?? '---',
            'PRE TRANSACTION ID' =>(string) $this->pre_transaction_id ?? '---',
            'USER' => optional($this->user)->name,
            'USER CONTACT NO.' => optional($this->user)->mobile_no,
            'USER EMAIL' => optional($this->user)->email,
            'ACCOUNT' => $this->account,
            'AMOUNT' => (double) $this->amount,
            'FEE' => (double) $this->fee ?? 0,
            'VENDOR' => $this->vendor,
            'SERVICE TYPE' => $this->service_type,
            'TRANSACTION ID' => $transactionId,
            'DESCRIPTION' => $this->description,
            'CASHBACK AMOUNT' => $this->cashback_amount,
            'CREATED AT' => (string) $this->created_at
        ];
    }
}
