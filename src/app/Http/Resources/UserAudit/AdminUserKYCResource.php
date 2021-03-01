<?php

namespace App\Http\Resources\UserAudit;

use App\Models\AdminUserKYC;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminUserKYCResource extends JsonResource
{

    private function resolveDescription()
    {
        switch ($this->status) {
            case AdminUserKYC::ACCEPTED:
                return "KYC ACCEPTED";
                break;
            case AdminUserKYC::REJECTED:
                return "KYC REJECTED";
                break;
            default:
                return "";
                break;
        }
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
