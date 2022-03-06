<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AgentDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        if ($this->agent){
            return [
                'AGENT' => $this->name . "-" . $this->email,
                'AGENT TYPE' => optional(optional($this->agent)->agentType)->name,
                'PARENT AGENT' => optional(optional($this->agent)->codeUsed)->name ?? "" . "--" . optional(optional($this->agent)->codeUsed)->email ?? "" . "--" . optional(optional($this->agent)->codeUsed)->mobile_no ?? "",
                'CONTACT NUMBER' => $this->mobile_no,
                'INSTITUTION TYPE' => $this->agent->institution_type ?? "",
                'BUSINESS NAME' => $this->agent->business_name ?? "",
                'BUSINESS PAN' =>  $this->agent->business_pan ?? "",
                'AGENT STATUS' => $this->agent->status ?? "",
                'REFERENCE CODE' =>  $this->agent->reference_code ?? "",
                'USE PARENT AGENT BALANCE' => $this->agent->use_parent_balance ?? "",
                'DATE OF BIRTH' => $this->kyc->date_of_birth ?? null,
                'IDENTITY TYPE' => $this->kyc->document_type ?? null,
                'IDENTITY NUMBER' => $this->kyc->id_no ?? "" ,
                'IDENTITY ISSUE DATE' => $this->kyc->c_issued_date ?? null,
                'IDENTITY ISSUE FROM' => $this->kyc->c_issued_from ?? null,
                'AGENT CREATED AT' => Carbon::parse($this->agent->created_at)->format('F d Y'),
            ];
//        }
    }
}
