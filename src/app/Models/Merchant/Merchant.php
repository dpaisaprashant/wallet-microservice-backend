<?php

namespace App\Models\Merchant;

use App\Filters\User\UserFilters;
use App\Models\AdminMerchantKYC;
use App\Models\Architecture\SingleUserCashback;
use App\Models\Architecture\SingleUserCommission;
use App\Models\MerchantBankAccount;
use App\Models\MerchantNchlBankTransfer;
use App\Models\MerchantNchlLoadTransaction;
use App\Models\MerchantTransaction;
use App\Models\MerchantTransactionEvent;
use App\Wallet\Commission\Models\Commission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class Merchant extends Model
{
    use Notifiable;

    const LOCK_MINUTES = 60;

    protected $connection = 'dpaisa';

    protected $guarded = [];

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new UserFilters($request))->add($filters)->filter($builder);
    }

    public function wallet()
    {
        return $this->hasOne(MerchantWallet::class);
    }

    public function kyc()
    {
        return $this->hasOne(MerchantKYC::class);
    }

    public function nchlBankTransfers()
    {
        return $this->hasMany(MerchantNchlBankTransfer::class);
    }

    public function nchlLoadTransactions()
    {
        return $this->hasMany(MerchantNchlLoadTransaction::class);
    }

    public function merchantTransaction()
    {
        return $this->hasMany(MerchantTransaction::class);
    }

    public function transactionEvents()
    {
        return $this->hasMany(MerchantTransactionEvent::class);
    }


    public function loginAttempts()
    {
        return $this->hasMany(MerchantLoginHistory::class, 'merchant_id');
    }

    public function merchantMerchantTransactionEvent()
    {
        return $this->hasMany(MerchantTransactionEvent::class, 'merchant_id');
    }

    public function bankAccount()
    {
        return $this->hasOne(MerchantBankAccount::class, 'merchant_id');
    }

    public function merchantCommission()
    {
        $commissionsId = $this->merchantMerchantTransactionEvent()
            ->where(function ($query) {
                return $query->whereServiceType('COMMISSION')->orWhere('service_type', 'MERCHANT_COMMISSION');
            })
            ->where('merchant_id', $this->id)
            ->pluck('transaction_id');

        return Commission::with('transactions')->whereIn('id', $commissionsId);
    }


    public function merchantAcceptRejectKyc()
    {
        if (empty($this->kyc()->first())) {
            return null;
        }
        $kycId = $this->kyc()->first()->id;

        return AdminMerchantKYC::where('kyc_id', $kycId);
    }

    /**
     * Get the number of failed attempts by user
     *
     * @return int
     */
    public function failedAttemptsCount()
    {
        return $this->loginAttempts()
            ->where("status", 0)->where("created_at", ">", now()
                ->subMinutes(self::LOCK_MINUTES))
            ->count();
    }

    /**
     * Check if the user is locked
     *
     * @return boolean
     */
    public function isLocked()
    {
        return $this->failedAttemptsCount() > 5;
    }

    public function depositSum()
    {
        return $this->nchlBankTransfers()
                ->where('debit_status', '000')
                ->where(function ($query) {
                    return $query->where('credit_status', '000')->orWhere('credit_status', '999');
                })
                ->sum("amount") / 100;
    }

    public function receivedSum()
    {
        return $this->merchantTransaction()
                ->where('status', MerchantTransaction::STATUS_COMPLETE)
                ->sum("amount") / 100;
    }

    public function loadedSum()
    {
        return $this->nchlLoadTransactions()
            ->where('status', 'SUCCESS')
            ->sum('amount') / 100;
    }

    public function hasValidKyc()
    {
        return $this->kyc ? $this->kyc->accept : false;
    }


    //Architecture
    public function singleUserCashbacks()
    {
        return $this->morphMany(SingleUserCashback::class, 'userCashbackable', 'user_type', 'user_id', 'id');
    }

    public function singleUserCommissions()
    {
        return $this->morphMany(SingleUserCommission::class, 'userCommissionable', 'user_type', 'user_id', 'id');
    }


}
