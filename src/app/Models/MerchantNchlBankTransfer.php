<?php

namespace App\Models;

use App\Traits\BelongsToMerchant;
use App\Traits\MerchantTransactionable;
use Illuminate\Database\Eloquent\Model;

class MerchantNchlBankTransfer extends Model
{
    use BelongsToMerchant, MerchantTransactionable;

    protected $connection = 'dpaisa';

    protected $guarded = [];

    public function userBankAccount()
    {
        return $this->belongsTo(MerchantBankAccount::class, 'merchant_bank_account_id');
    }

    public function getAmountAttribute($amount)
    {
        return ($amount/100);
    }


    public function successfulBankTransfer()
    {
        if (($this->credit_status == '000' || $this->credit_status == '999') &&
            ($this->debit_status == '000')) {
            return true;
        }
        return false;
    }

    public function pendingBankTransfer()
    {
        if ($this->debit_status == 'ENTR' || $this->credit_status == 'ENTR') {
            return true;
        }
        return false;
    }
}
