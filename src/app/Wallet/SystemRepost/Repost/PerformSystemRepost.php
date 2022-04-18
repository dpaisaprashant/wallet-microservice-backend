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
        $this->transactionType = request()->transaction_type;
        $this->updateBalance = request()->update_balance ? 1 : 0;
        $this->updateTimeStamp = request()->update_timestamp ? 1 :0;
    }


    public function repost()
    {

        //1. save to system_reposts table
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
            'transaction_type' => $this->transactionType
        ];

        $system_repost_data['before_balance'] = $this->preTransaction->user->wallet->balance;
        $system_repost_data['before_bonus_balance'] = $this->preTransaction->user->wallet->bonus_balance;
        $system_repost_data['after_bonus_balance'] = $this->preTransaction->user->wallet->bonus_balance;

        $systemRepost = SystemRepost::create($system_repost_data);
//        dd($systemRepost);


        //2. check db
        /**
         *
         * @returns ["before_status" => "failed"]
         */
        $dbCheckResponse = $this->checkByDatabaseStrategy->checkMicroserviceDatabaseStatus($this->preTransaction);
        if ($dbCheckResponse['load_status'] == "no records found") {
            $systemRepost->update(['status' => "ERROR", 'error_description' => "Cannot find record in microservice for the given pre_transaction_id"]);
            return back()->with("error", "pre Transaction Record Does not Exist in the Relevant Transaction Type's Database");
        }elseif ($dbCheckResponse['load_status'] == "Transaction Success"){
            $systemRepost->update(['status' => "ERROR", 'error_description' => "Transaction is success in microservice"]);
            return back()->with("error", "pre Transaction Record Does not Exist in the Relevant Transaction Type's Database");
        } // checking if the microservice status is success or not!

        //3. check api
        $this->checkByApiStrategy->checkMicroserviceApiStatus();

        //4. rep[post the transdaction
        /**
         *
         * @returns ["after_status" => "success", "after_balance" => 10, "after_bonus_balance" => 2]
         */
        $this->systemRepostStrategy->performRepost(
            $this->preTransaction,
            $systemRepost,
            $dbCheckResponse,
        );

        //update table
        Log::info("7. Update system_repost table");

    }

}
