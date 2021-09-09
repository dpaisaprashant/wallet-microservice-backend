<?php

namespace App\Models\Architecture;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class WalletTransactionBonus extends Model
{
    use BelongsToUser;

    protected $connection = 'dpaisa';

    protected $guarded = [];

    protected $table = 'wallet_transaction_type_bonus_points';

    public function transactionBonusPoint()
    {
        return $this->morphTo('transactionBonusPoint', 'user_type', 'user_type_id');
    }




}
