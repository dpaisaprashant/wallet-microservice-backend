<?php

namespace App\Models\Architecture;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class WalletTransactionBonus extends Model
{
    use BelongsToUser, LogsActivity;

    protected static $logAttributes = ['*'];
    //protected static $logOnlyDirty = true;
    protected static $logName = 'Wallet Transaction Bonus';

    protected $connection = 'dpaisa';

    protected $guarded = [];

    protected $table = 'wallet_transaction_type_bonus_points';

    public function transactionBonusPoint()
    {
        return $this->morphTo('transactionBonusPoint', 'user_type', 'user_type_id');
    }




}
