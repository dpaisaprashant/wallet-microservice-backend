<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LinkedAccountsResource extends JsonResource
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
            'ACCOUNT NAME' => $this->account_name,
            'ACCOUNT NUMBER' =>  $this->account_number ,
            'BANK CODE' => $this->bank_code,
            'DATE OF BIRTH' => $this->dob ,
            'MOBILE NUMBER' => $this->mobile_number,
            'REFERENCE ID' => $this->reference_id,
            'RESGISTRATION DATE' => $this->register_date,
            'REGISTER STATUS' => $this->register_status,
            'TIME STAMP' => $this->time_stamp,
            'TOKEN' => $this->token,
            'USER ID'=>$this->user_id,
            'USER PHONE NUMBER'=>optional($this->user)->mobile_no,
            'VERIFIED STATUS'=>$this->verified_status,
            'VERIFIED TIME STAMP'=>$this->verified_time_stamp,
            'CREATED AT' => (string) $this->created_at
        ];
    }
}
