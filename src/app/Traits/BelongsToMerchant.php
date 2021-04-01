<?php


namespace App\Traits;

use App\Models\Merchant\Merchant;

trait BelongsToMerchant
{
    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }
}
