<?php

namespace App\Traits;


/**
 * Relation for the user
 */
trait WalletDetails
{
    public function addBalance($userId, $amount)
    {
        return $this->where('user_id', $userId)->increment('balance', $amount);
    }

    public function subtractBalance($userId, $amount)
    {
        return $this->where('user_id', $userId)->decrement('balance', $amount);
    }
}
