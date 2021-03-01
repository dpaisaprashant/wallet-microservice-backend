<?php

namespace App\Traits;


use App\Models\Dispute;

/**
 * Relation for the user
 */
trait MorphOneDispute
{
    public function dispute()
    {
        return $this->morphOne(Dispute::class, 'disputeable', 'transaction_type', 'transaction_id');
    }
}
