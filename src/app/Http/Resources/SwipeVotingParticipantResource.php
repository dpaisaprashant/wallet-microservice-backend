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
            $status = 'DISQUALIFIED';
        }

        if  ($this->json_form_data != null){
            $json_data = json_decode($this->json_form_data,true);
        }else{
            $json_data = [];
        }

        $excel_data = [
            'NAME' => $this->name,
            'MOBILE' => $this->mobile_no,
            'IMAGE' => config('dpaisa-api-url.swipe-voting-participant-image-url') . $this->image,
            'STATUS' => $status,
            'EVENT CODE' => $this->event_code,
            'CREATED AT' => $this->created_at,
        ];

        if (!empty($json_data)){
            $excel_data = array_merge($excel_data,$json_data);
        }
        return $excel_data;

    }
}
