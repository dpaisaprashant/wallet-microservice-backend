<?php

namespace App\Wallet\SystemRepost\Repost;

use App\Events\UserBonusWalletPaymentEvent;
use App\Events\UserBonusWalletUpdateEvent;
use App\Events\UserWalletPaymentEvent;
use App\Events\UserWalletUpdateEvent;
use App\Models\Microservice\PreTransaction;
use App\Models\SystemRepost;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\Wallet;
use App\Wallet\SystemRepost\Repost\Contracts\CheckByApiContract;
use App\Wallet\SystemRepost\Repost\Contracts\CheckByDatabaseContract;
use App\Wallet\SystemRepost\Repost\Contracts\SystemRepostContract;
use App\Wallet\SystemRepost\Repost\Exception\SystemRepostValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PerformSystemRepost
{

    private CheckByDatabaseContract $checkByDatabaseStrategy;
    private CheckByApiContract $checkByApiStrategy;
    private SystemRepostContract $systemRepostStrategy;
    private PreTransaction $preTransaction;
    private string $transactionType;
    private int $updateBalance;
    private int $updateTimeStamp;
    private int $fromMain;
    private int $fromBonus;

    public function __construct(CheckByDatabaseContract $checkByDatabaseStrategy,
                                CheckByApiContract      $checkByApiStrategy,
                                SystemRepostContract    $systemRepostStrategy,
                                PreTransaction          $preTransaction
    )
    {
        $this->checkByDatabaseStrategy = $checkByDatabaseStrategy;
        $this->checkByApiStrategy = $checkByApiStrategy;
        $this->systemRepostStrategy = $systemRepostStrategy;
        $this->preTransaction = $preTransaction;
        $this->preTransaction->load("user", "user.wallet");
        $this->transactionType = request()->transaction_type;
        $this->updateBalance = request()->update_balance ? 1 : 0;
        $this->updateTimeStamp = request()->update_timestamp ? 1 : 0;
        $this->fromBonus = request()->from_bonus * 100;
        $this->fromMain = request()->from_main * 100;
    }

    private function createSystemRepost(): SystemRepost
    {
        Log::info("3. Save to system_repost table");
        $system_repost_data = [
            'admin_id' => auth()->user()->id,
            'user_id' => $this->preTransaction->user_id,
            'pre_transaction_id' => $this->preTransaction->pre_transaction_id,
            'amount' => $this->preTransaction->amount * 100,
            'type' => $this->preTransaction->transaction_type,
            'status' => "PENDING",
            'update_balance' => $this->updateBalance,
            'latest_date' => $this->updateTimeStamp,
            'transaction_type' => $this->transactionType,
            'before_balance' => $this->preTransaction->user->wallet->balance * 100,
            'before_bonus_balance' => $this->preTransaction->user->wallet->bonus_balance * 100,
        ];

        return SystemRepost::create($system_repost_data);
    }


    public function repost()
    {
        //1. save to system_reposts table
        $systemRepost = $this->createSystemRepost();

        //2. check db from respective microservice tables
        /**
         *
         * @returns [
         *          "before_transaction_status" => "failed" / null,
         *          "error_description" => "reason for error",
         *          "status" => "ERROR" / "PROCESSING"
         *       ]
         */
        $dbCheckResponse = $this->checkByDatabaseStrategy->checkMicroserviceDatabaseStatus($this->preTransaction);
        //2.1 update db status check
        $systemRepost->update([
            "before_transaction_status" => $dbCheckResponse["before_transaction_status"] ?? null,
            "error_description" => $dbCheckResponse["error_description"],
            "status" => $dbCheckResponse["status"]
        ]);

        //2.2 return if repost condition is not met
        if ($dbCheckResponse["status"] == "ERROR") {
            throw new SystemRepostValidationException($systemRepost);
        }

//        //3. check api
//        $apiCheckStatus = $this->checkByApiStrategy->checkMicroserviceApiStatus($this->preTransaction);
//        if (!$apiCheckStatus) {
//            $description = "Transaction Api status check failed";
//            $systemRepost->update([
//                "error_description" => $description,
//                "status" => "ERROR"
//            ]);
//            throw new SystemRepostValidationException($systemRepost);
//
//        }


        //4. repost the transaction
        try {
            DB::beginTransaction();

            $transactionEvent = $this->systemRepostStrategy->performRepost($this->preTransaction);

            if (!$transactionEvent instanceof TransactionEvent) {
                Log::info("7. Creating transaction event failed", [$this->preTransaction]);
                return false;
            }


            //5.update balance check
            if ($this->updateBalance) {
                $userId = $this->preTransaction->user_id;
                //5.1. update balance enabled
                // updating the user's wallet balance
                if ($transactionEvent->account_type == PreTransaction::TRANSACTION_TYPE_CREDIT) {

                    if ($this->fromMain > 0) {
                        event(new UserWalletUpdateEvent($userId, $this->fromMain));
                    }

                    if ($this->fromBonus > 0) {
                        event(new UserBonusWalletUpdateEvent($userId, $this->fromBonus));
                    }
                } elseif ($transactionEvent->account_type == PreTransaction::TRANSACTION_TYPE_DEBIT) {
                    if ($this->fromMain > 0) {
                        event(new UserWalletPaymentEvent($userId, $this->fromMain));
                    }
                    if ($this->fromBonus > 0) {
                        event(new UserBonusWalletPaymentEvent($userId, $this->fromBonus));
                    }
                }
            }

            //6. update balance and bonus balance in transaction event
            $userWallet = Wallet::where("user_id", $userId)->first();
            //updating the balance in the transaction Event
            $transactionEvent->update([
                "balance" => $userWallet->balance * 100,
                "bonus_balance" => $userWallet->bonusBalance * 100,
                "from_main" => $this->fromMain,
                "from_bonus" => $this->fromBonus,
            ]);


            Log::info("7. Update system_repost table");
            $systemRepost->update([
                "after_balance" => $userWallet->balance * 100,
                "after_bonus_balance" => $userWallet->bonusBalance * 100,
                "after_transaction_status" => "SUCCESS",
                "status" => "SUCCESS"
            ]);
            //7. update system repost


            Log::info("7. Update pre transaction status");
            //updating the pre_transaction status
            $this->preTransaction->update([
                "status" => PreTransaction::STATUS_SUCCESS
            ]);

            DB::commit();

            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            $systemRepost->update([
                "error_description" => "Something Went Wrong",
                "status" => "ERROR"
            ]);
            throw new SystemRepostValidationException($systemRepost);
        }

    }

}
