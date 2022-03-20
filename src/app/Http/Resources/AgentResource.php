<?php

namespace App\Http\Resources;

use App\Models\Agent;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AgentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

//        checking agent status
        if ($this->agent->status == Agent::STATUS_PROCESSING) {
            $agent_status = "processing";
        } elseif ($this->agent->status == Agent::STATUS_ACCEPTED) {
            $agent_status = "Accepted";
        } elseif ($this->agent->status == Agent::STATUS_REJECTED) {
            $agent_status = "Rejected";
        } else {
            $agent_status = "--";
        }

//      checking if the agent uses the parent agent's balance
        if ($this->agent->user_parent_balance == 1) {
            $parent_balance = "uses parent agent's balance";
        } else {
            $parent_balance = "uses own balance";
        }

        return [
            'AGENT' => $this->name . "-" . $this->email,
            'AGENT TYPE' => ucwords(strtolower(optional(optional($this->agent)->agentType)->name)),
            'PARENT AGENT' => optional(optional($this->agent)->codeUsed)->name,
            'CONTACT NUMBER' => $this->mobile_no,
            'INSTITUTION TYPE' => $this->agent->institution_type,
            'BUSINESS NAME' => $this->agent->business_name,
            'BUSINESS PAN' => $this->agent->business_pan,
            'AGENT STATUS' => $agent_status,
            'REFERENCE CODE' => $this->agent->reference_code,
            'USES PARENT AGENT BALANCE' => $parent_balance,
            'DATE' => (string)$this->created_at,
        ];
//        }
    }
}
