<?php

namespace App\Http\Resources\UserAudit;

use Illuminate\Http\Resources\Json\JsonResource;

class FundTransferResource extends JsonResource
{

    private $userId;

    /**
     * @param mixed $userId
     * @return FundTransferResource
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    private function resolveDescription()
    {
        if ($this->userId == $this->from_user) {
            return 'SEND TRANSFER FUND';
        }
        return 'RECEIVE TRANSFER FUND';
    }

    private function resolveDebit()
    {
        if ($this->userId == $this->from_user) {
            return $this->amount;
        }
        return null;
    }

    private function resolveCredit()
    {
        if ($this->userId != $this->from_user) {
            return $this->amount;
        }
        return null;
    }

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
            'DESCRIPTION' => $this->resolveDescription(),
            'VENDOR' => '---',
            'STATUS' => 'Successful',
            'DEBIT' => $this->resolveDebit(),
            'CREDIT' => $this->resolveCredit(),
            'BALANCE' => $this->current_balance,
        ];
    }


}
