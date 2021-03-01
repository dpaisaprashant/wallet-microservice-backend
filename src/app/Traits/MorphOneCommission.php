<?php

namespace App\Traits;



use App\Wallet\Commission\Models\Commission;

/**
 * Relation for the user
 */
trait MorphOneCommission
{
    public function commission()
    {
        return $this->morphOne(Commission::class, 'commissionable', 'commissionable_type', 'commissionable_id');
    }
}
