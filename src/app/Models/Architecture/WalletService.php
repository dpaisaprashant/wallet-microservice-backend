<?php

namespace App\Models\Architecture;

use Illuminate\Database\Eloquent\Model;

class WalletService extends Model
{
    protected $connection = 'dpaisa';
    protected $guarded = [];
    protected $table = 'wallet_services';

    public function walletTransactionType()
    {
        return $this->belongsTo(WalletTransactionType::class);
    }
}
