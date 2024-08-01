<?php


namespace App\Wallet\WalletAPI\Traits;


use App\Events\UserBonusWalletPaymentEvent;
use App\Events\UserWalletPaymentEvent;
use App\Models\User;
use App\Models\Wallet;
use App\Wallet\WalletAPI\Exceptions\ArchitectureValidationException;
use App\Wallet\WalletAPI\Validations\UserBonusBalanceValidation;
use App\Wallet\Architecture\Validations\WalletTransactionTypeValidation;
use App\Wallet\BonusBalance\TransactionBonusBalance;
use App\Wallet\Helpers\ErrorGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

trait DeductBalanceBeforeRequest
{
    public function deductUserBalance(User $user, WalletTransactionTypeValidation $validator)
    {
        $walletTransactionType = $validator->getWalletTransactionType();
        $amount = $validator->getAmount();
        //$commission = (new UserBonusBalanceValidation())->getCommission($user, $amount, $walletTransactionType);

        Log::info("DeductBalanceBeforeRequest try to get wallet");
        $userWallet =  Wallet::where('user_id', $user->id)->first();
        Log::info("DeductBalanceBeforeRequest try to get wallet", [$userWallet]);


        $userWallet->update([
            "before_balance" => $balance = $userWallet->balance,
            "before_bonus_balance" => $bonusBalance = $userWallet->bonus_balance
        ]);

        Log::info("transaction type: " . $walletTransactionType->transaction_type, [$walletTransactionType]);
        //$bonusCalculator = new TransactionBonusBalance($user, $amount + $commission, $walletTransactionType);
        $bonusCalculator = new TransactionBonusBalance($user, $amount, $walletTransactionType);
        $payFromMain = $bonusCalculator->getAmountToDeductFromMainBalance() ?? 0;
        $payFromBonus = $bonusCalculator->getAmountToDeductFromBonusBalance() ?? 0;

        if ($payFromMain > $balance) {
            throw new ArchitectureValidationException(["message" => "Insufficient main balance"]);
        }

        if ($payFromBonus > $bonusBalance) {
            throw new ArchitectureValidationException(["message" => "Insufficient bonus balance"]);
        }


        Log::info("Pay From Bonus: ". $payFromBonus );
        if ($payFromBonus > 0) {
            event(new UserBonusWalletPaymentEvent($user->id, $payFromBonus));
        }

        Log::info("Pay From Main: ". $payFromMain );
        if ($payFromMain > 0) {
            event(new UserWalletPaymentEvent($user, $payFromMain));
        }
    }
}
