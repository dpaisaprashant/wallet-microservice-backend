<?php

namespace App\Http\Resources;

use App\Models\Merchant\Merchant;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletTransactionTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->user_type = User::class){
            $user_type = "User";
        }elseif($this->user_type = Merchant::class){
            $user_type = "Merchant";
        }else{
            $user_type = "---";
        }

        if ($this->service_enabled == 1){
            $service_enabled = "Enabled";
        }else{
            $service_enabled = "Disabled";
        }

        if ($this->vendor == "BFI"){
            return [
                'User Type' => $user_type,
                'Vendor' => ($this->vendor ?? "--") . ($this->special1 ?? ''),
                'BFI Name' => $this->special2 ?? "--",
                'Transaction Category' => $this->transaction_category ?? "--",
                'Service Type' => $this->service_type ?? "--",
                'Service' => $this->service ?? "--",
                'Service Enabled' => $service_enabled,
                'Payment Type' => $this->payment_type ?? "--",
            ];
        }else{
            return [
                'User Type' => $user_type,
                'Vendor' => $this->vendor ?? "--",
                'Transaction Category' => $this->transaction_category ?? "--",
                'Service Type' => $this->service_type ?? "--",
                'Service' => $this->service ?? "--",
                'Service Enabled' => $service_enabled,
                'Payment Type' => $this->payment_type ?? "--",
            ];
        }



    }
}
