<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCheckPaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $completedDate = 'not available';
        if (isset($this->userTransaction['created_at'])) {

            $completedDate = $this->userTransaction['created_at'];
        }

        return [
            'REF_STAN' => $this->refStan,
            'BILL NUMBER' => $this->bill_number,
            'CHECK CODE' => $this->code,
            'USER' => $this->user->name,
            'USER NUMBER' => $this->user->mobile_no,
            'ACCOUNT' => $this->userTransaction['account'] ?? 'not available',
            'AMOUNT' => $this->userTransaction['amount'] ?? 'not available',
            'VENDOR' => $this->userTransaction['vendor'] ?? 'not available',
            'STATUS' => $this->getStatus(),
            'COMPLETED DATE' => (string) $completedDate
        ];
    }
}
