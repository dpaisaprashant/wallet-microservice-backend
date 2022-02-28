<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminUpdateKycResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $response = json_decode($this->kyc_before_change);
        if ($response == null){
            $action = "Created";
        }else{
            $action = "Updated";
        }

        return [
            'Admin' => optional($this->admin)->name,
            'User-kyc' => optional(optional($this->userKyc)->user)->mobile_no,
            'Admin Action' => $action,
            'Date' => (string) $this->created_at,
        ];
    }
}
