<?php

namespace App\Http\Resources;

use App\Models\TransactionEvent;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class NonRealTimeBankTransferResource extends JsonResource
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
            'Admin' => $this->backendNonRealTime->admin->name ?? "---",
            'Transaction ID' => $this->transaction_id,
            'Amount' => $this->amount,
            'Transaction Fee' => $this->transaction_fee,
            'Debit Response ID' => $this->debit_response_id,
            'Credit Response ID' => $this->credit_response_id,
            'Debit Status' => $this->debit_status,
            'Credit Status' => $this->credit_status,
            'Debit Response Message' => $this->debit_response_message,
            'Credit Response Message' => $this->credit_response_message,
            'Vendor' => $this->vendor,
        ];
    }
}
