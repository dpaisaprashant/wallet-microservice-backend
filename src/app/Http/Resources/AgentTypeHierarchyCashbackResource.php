<?php

namespace App\Http\Resources;

use App\Models\Agent;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AgentTypeHierarchyCashbackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'ID' => $this->id,
            'Agent Type' => optional($this->agentType)->name,
            'Parent Agent Type' => optional($this->parentAgentType)->name,
            'Title' => $this->title,
            'Cashback Type' => $this->cashback_type,
            'Cashback Value (Rs.)' => $this->cashback_type == "FLAT" ? $this->cashback_value/100 : $this->cashback_value ,
            'Slab From' => $this->slab_from,
            'Slab To' => $this->slab_to,
            'Description' => $this->description,
        ];
    }
}
