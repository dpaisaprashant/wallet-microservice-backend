<?php


namespace App\Wallet\WalletAPI\Validations;


use App\Models\Architecture\WalletTransactionType;
use App\Repository\Commission\UserCommissionRepository;
use App\Wallet\Architecture\Validations\Contracts\ValidateBalance;
use App\Wallet\Traits\WalletInfo;
use Illuminate\Support\Facades\Log;

class UserBonusBalanceValidation implements ValidateBalance
{
    use WalletInfo;

    public function getCommission($user, $amount, $walletTransactionType)
    {
        $repository = new UserCommissionRepository($user);
        return $repository->getTransactionCommission($amount, $walletTransactionType);
    }

    public function validate($user, $amount, WalletTransactionType $walletTransactionType)
    {

        Log::info("balance in user balance + bonus balance validation", [$user]);
        $amountToValidate = $amount + $this->getCommission($user, $amount, $walletTransactionType);
        Log::info("balance to validate", [$user]);


        if ($this->hasEnoughBalancePlusBonusBalanceWithLock($amountToValidate, $user)) {
            return true;
        }
        return false;
    }
}
