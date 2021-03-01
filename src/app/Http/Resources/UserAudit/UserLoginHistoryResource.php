<?php

namespace App\Http\Resources\UserAudit;

use Illuminate\Http\Resources\Json\JsonResource;

class UserLoginHistoryResource extends JsonResource
{

    private function resolveDescription()
    {
        if ($this->status == 1 && $this->tmp_enabled === 0) {
            return 'USER SUCCESSFULLY LOGGED IN';
        }
        return 'USER LOGIN ATTEMPT FAIL';
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
            'STATUS' => '---',
            'DEBIT' => '---',
            'CREDIT' => '---',
            'BALANCE' => $this->current_balance,
        ];
    }
}
