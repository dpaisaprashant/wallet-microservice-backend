<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class SwipeVotingVoteResource extends JsonResource
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
            'PARTICIPANT NAME' => $this->participant->name,
            'PARTICIPANT MOBILE' => $this->participant->mobile_no,
            'VOTER NAME' => $this->user->name,
            'VOTER MOBILE' => $this->user->mobile_no,
            'PARTICIPANT REGISTRATION DATE' => $this->participant->created_at,
            'VOTER REGISTRATION DATE' => $this->user->phone_verified_at,
            'VOTED AT' => $this->created_at,
            'EVENT CODE' => $this->participant->event_code,
        ];
    }
}
