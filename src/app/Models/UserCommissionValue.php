<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class UserCommissionValue extends Model
{
    use BelongsToUser;

    protected $connection = 'dpaisa';
    protected $guarded = [];

    public function getUserCommission($userId, $transactionType)
    {
        return $this->where('user_id', $userId)->where('transaction_type', $transactionType)->first() ?? null;
    }
}
