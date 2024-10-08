<?php

namespace App\Models\Architecture;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class WalletTransactionTypeCashback extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];
    //protected static $logOnlyDirty = true;
    protected static $logName = 'Wallet Transaction Type Cashback';


    protected $connection = 'dpaisa';

    protected $guarded = [];

    public function resolveCashbackBuilder($walletTransactionTypeId, $userTypeId, $userType)
    {
        return $this->where('wallet_transaction_type_id', $walletTransactionTypeId)
            ->where('user_type_id', $userTypeId)
            ->where('user_type', $userType);
    }

    public function getCurrentUserCashbackBuilder($userTypeId, $userType)
    {
        return $this->where('user_type_id', $userTypeId)
            ->where('user_type', $userType);
    }

    public function transactionCashbackable()
    {
        return $this->morphTo('transactionCashbackable', 'user_type', 'user_type_id');
    }


}
