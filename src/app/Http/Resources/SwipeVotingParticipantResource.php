<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class SwipeVotingParticipantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->status == 1) {
            $status = 'QUALIFIED';
        }else{
            $status = 'QUALIFIED';
        }

        return [
            'NAME' => $this->name,
            'MOBILE' => $this->mobile_no,
            'IMAGE' => config('dpaisa-api-url.swipe-voting-participant-image-url') . $this->image,
            'STATUS' => $status,
            'EVENT CODE' => $this->event_code,
            'CREATED AT' => $this->created_at,
        ];
    }
}
