<?php

namespace App\Wallet\SystemRepost\Repost;

use App\Models\Microservice\PreTransaction;
use App\Models\SystemRepost;
use App\Models\User;
use App\Wallet\SystemRepost\Repost\Contracts\CheckByApiContract;
use App\Wallet\SystemRepost\Repost\Contracts\CheckByDatabaseContract;
use App\Wallet\SystemRepost\Repost\Contracts\SystemRepostContract;
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
        $this->updateTimeStamp = request()->update_timestamp ? 1 :0;
    }

    private function createSystemRepost() : SystemRepost {
        Log::info("3. Save to system_repost table");
        $system_repost_data = [
            'admin_id' => auth()->user()->id,
            'user_id' => $this->preTransaction->user_id,
            'pre_transaction_id' => $this->preTransaction->pre_transaction_id,
            'amount' => $this->preTransaction->amount,
            'type' => $this->preTransaction->transaction_type,
            'status' => "PENDING",
            'update_balance' => $this->updateBalance,
            'latest_date' => $this->updateTimeStamp,
            'transaction_type' => $this->transactionType,
            'before_balance' => $this->preTransaction->user->wallet->balance,
            'before_bonus_balance' => $this->preTransaction->user->wallet->bonus_balance,
        ];

        return  SystemRepost::create($system_repost_data);
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
            return back()->with("error", $dbCheckResponse["error_description"]);
        }

        //3. check api
        $this->checkByApiStrategy->checkMicroserviceApiStatus();


        //4. repost the transaction
        /**
         *
         */

        $transaction_event = $this->systemRepostStrategy->performRepost($this->preTransaction);

        //update table
        Log::info("7. Update system_repost table");

    }

}
