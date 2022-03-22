<?php

namespace App\Http\Resources;

use App\Models\Agent;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminAlteredAgentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $response = json_decode($this->agent_before);
        if ($response == null){
            $action = "Created";
        }else{
            $action = "Updated";
        }

        return [
            'Admin' => optional($this->admin)->name,
            'Agent' => optional(optional($this->agent)->user)->mobile_no,
            'Admin Action' => $action,
            'Date' => (string) $this->created_at,
        ];
    }
}
