<?php

namespace App\Http\Resources;

use App\Models\UserRegisteredByUser;

class UserRegisteredByUserResource extends \Illuminate\Http\Resources\Json\JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $count = UserRegisteredByUser::with('user','UserWhoRegistered')->where('registered_by_id','=',$this->registered_by_id)->count();

        return [
            'Registered User' => $this->user->mobile_no,
            'Agent Who Registered' => $this->UserWhoRegistered->mobile_no,
            'Total Registrations By Agent' => $count,
            'Date' => (string) $this->created_at,
        ];
    }
}
