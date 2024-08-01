<?php


namespace App\Wallet\Limits\Traits;


use App\Models\Agent;
use App\Models\User;
use App\Wallet\Limits\Resolver\UserLimitCheckResolver;
use App\Wallet\Limits\Strategies\BankTransferLimitCheckerStrategy;
use App\Wallet\Limits\Strategies\LoadLimitCheckerStrategy;
use App\Wallet\Limits\Strategies\PaymentLimitCheckerStrategy;
use App\Wallet\Limits\Strategies\TransferLimitCheckerStrategy;
use App\Wallet\Limits\Strategies\UserBankTransferAmountStrategy;
use App\Wallet\Limits\Strategies\UserLoadTransactionAmountStrategy;
use App\Wallet\Limits\Strategies\UserPaymentTransactionAmountStrategy;
use App\Wallet\Limits\Strategies\UserTransferAmountStrategy;

trait CheckLimit
{
    public function checkPaymentLimit(User $user, $amount)
    {
        (new UserLimitCheckResolver(
            $user,
            $amount,
            new PaymentLimitCheckerStrategy($user),
            new UserPaymentTransactionAmountStrategy($user),
            'Payment'

        ))->resolve();
    }

    public function checkLoadLimit(User $user, $amount)
    {
        (new UserLimitCheckResolver(
            $user,
            $amount,
            new LoadLimitCheckerStrategy($user),
            new UserLoadTransactionAmountStrategy($user),
            'Load'

        ))->resolve();
    }

    public function checkTransferLimit(User $user, $amount, $type = 'Transfer')
    {
        (new UserLimitCheckResolver(
            $user,
            $amount,
            new TransferLimitCheckerStrategy($user),
            new UserTransferAmountStrategy($user),
            $type

        ))->resolve();
    }

    public function checkBankTransferLimit(User $user, $amount)
    {
        (new UserLimitCheckResolver(
            $user,
            $amount,
            new BankTransferLimitCheckerStrategy($user),
            new UserBankTransferAmountStrategy($user),
            'Bank Transfer'

        ))->resolve();
    }

    public function resolveAndCheckLimit($user, $amount, $limitType)
    {
        switch ($limitType) {
            case "LOAD":
                $this->checkLoadLimit($user, $amount);
                break;
            case "PAYMENT":
                $this->checkPaymentLimit($user, $amount);
                break;
            case "TRANSFER":
                $this->checkTransferLimit($user, $amount);
                break;
            case "BANK_TRANSFER":
                $this->checkBankTransferLimit($user, $amount);
                break;
            default:
                break;
        }
    }
}
