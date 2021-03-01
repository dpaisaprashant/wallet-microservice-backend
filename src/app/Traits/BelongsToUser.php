<?php

namespace App\Traits;

use App\Models\User;

/**
 * Relation for the user
 */
trait BelongsToUser
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
