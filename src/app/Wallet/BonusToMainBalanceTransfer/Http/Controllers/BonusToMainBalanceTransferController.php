<?php


namespace App\Wallet\BonusToMainBalanceTransfer\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\BonusToMainBalanceTransfer\MainBalanceAddition;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\Wallet;
use App\Wallet\Helpers\TransactionIdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Microservice\PreTransaction;

class BonusToMainBalanceTransferController extends Controller
{
    public function TransferBonusToMain(Request $request,$id){ // the function receives the amount to be transferred and the id of the user and the description(optional) of the transfer
        //validations
        $userWallet = Wallet::where('user_id','=',$id)->first();
        $started_pre_transaction = PreTransaction::where('user_id','=',$id)->where('status','=','STARTED')->first();
        if ($request->amount <= $userWallet->bonus_balance && empty($started_pre_transaction)){
            $bonus_balance_deduct_pre_transaction = $this->CreateBonusBalanceDeductPreTransaction($request->amount,$id);
            $main_balance_addition_pre_transaction = $this->CreateMainBalanceAdditionPreTransaction($request->amount,$id, $bonus_balance_deduct_pre_transaction['after_bonus_balance'], $bonus_balance_deduct_pre_transaction['after_balance']);
                try {
                    DB::connection('dpaisa')->beginTransaction();
                    $bonus_to_main_balance_transfer = $this->CreateBonusToMainBalanceTransfer($request->amount, $id, $request->description);
                    $update_bonus_balance_deduct = PreTransaction::where('pre_transaction_id','=',$bonus_balance_deduct_pre_transaction->pre_transaction_id)->first();
                    $update_status['status'] = "SUCCESS";
                    $update_bonus_balance_deduct->update($update_status);
                    $update_main_balance_addition = PreTransaction::where('pre_transaction_id','=',$main_balance_addition_pre_transaction->pre_transaction_id)->first();
                    $update_main_balance_addition->update($update_status);
                    $bonus_balance_deduction_transaction_event = $this->CreateBonusBalanceDeductionTransactionEvent(
                        $request->amount,
                        $id,
                        $bonus_balance_deduct_pre_transaction['pre_transaction_id'],
                        $request->description,
                        $bonus_to_main_balance_transfer['id'],
                        $bonus_balance_deduct_pre_transaction['after_balance'],
                        $bonus_balance_deduct_pre_transaction['after_bonus_balance'],
                    );
                    $deduct_user_bonus_balance = $this->DeductUserBonusBalance(
                        $bonus_balance_deduct_pre_transaction['after_balance'],
                        $bonus_balance_deduct_pre_transaction['after_bonus_balance'],
                        $bonus_balance_deduct_pre_transaction['before_balance'],
                        $bonus_balance_deduct_pre_transaction['before_bonus_balance'],
                        $userWallet,
                    );
                    $main_balance_addition_transaction_event = $this->CreateMainBalanceAdditionTransactionEvent(
                        $request->amount,
                        $id,
                        $main_balance_addition_pre_transaction['pre_transaction_id'],
                        $request->description,
                        $bonus_to_main_balance_transfer['id'],
                        $main_balance_addition_pre_transaction['after_balance'],
                        $main_balance_addition_pre_transaction['after_bonus_balance']
                    );
                    $add_user_main_balance = $this->AddUserMainBalance(
                        $main_balance_addition_pre_transaction['after_balance'],
                        $main_balance_addition_pre_transaction['after_bonus_balance'],
                        $main_balance_addition_pre_transaction['before_balance'],
                        $main_balance_addition_pre_transaction['before_bonus_balance'],
                        $userWallet,
                    );

                    DB::connection('dpaisa')->commit();
                    return redirect()->back()->with('success','Bonus Balance transferred to Main Balance');
                }catch (\Exception $e){
                    DB::connection('dpaisa')->rollBack();
                    $update_status['status'] = "FAILED";
                    $update_bonus_balance_deduct = PreTransaction::where('pre_transaction_id','=',$bonus_balance_deduct_pre_transaction->pre_transaction_id)->first();
                    $update_bonus_balance_deduct->update($update_status);
                    $update_main_balance_addition = PreTransaction::where('pre_transaction_id','=',$main_balance_addition_pre_transaction->pre_transaction_id)->first();
                    $update_main_balance_addition->update($update_status);
                    return redirect()->route('user.profile',$id)->with('error','Error, bonus balance could not be transferred to Main Balance');
                }

        }
        else{
            return redirect()->route('user.profile',$id)->with('error','Insufficient Bonus Balance or User is involved in another transaction at the moment');
        }


    }

    public function CreateBonusBalanceDeductPreTransaction($amount, $id){
        //create row in pre-transactions to record a debit transaction of deducting the bonus balance from the user.
        $pre_transaction_debit = [];
        $pre_transaction_debit['user_id'] = $id;
        $pre_transaction_debit['pre_transaction_id'] = TransactionIdGenerator::generate(20);
        $pre_transaction_debit['amount'] = $amount * 100;
        $pre_transaction_debit['description'] = "Amount Deducted From Bonus Balance";
        $pre_transaction_debit['vendor'] = PreTransaction::MICROSERVICE_WALLET;
        $pre_transaction_debit['service_type'] = "Bonus Balance To Main Balance Transfer";
        $pre_transaction_debit['microservice_type'] = PreTransaction::MICROSERVICE_WALLET;
        $pre_transaction_debit['transaction_type'] = "debit";
        $pre_transaction_debit['url'] = "/bonusToMainBalanceTransfer";
        $pre_transaction_debit['status'] = "STARTED";
        $pre_transaction_debit['before_balance'] = Wallet::where('user_id','=',$id)->pluck('balance')[0] * 100;
        $pre_transaction_debit['after_balance'] = $pre_transaction_debit['before_balance'];
        $pre_transaction_debit['before_bonus_balance'] = Wallet::where('user_id','=',$id)->pluck('bonus_balance')[0] * 100;
        $pre_transaction_debit['after_bonus_balance'] = $pre_transaction_debit['before_bonus_balance'] - ($amount * 100) ;

        return PreTransaction::create($pre_transaction_debit);
    }

    public function CreateMainBalanceAdditionPreTransaction($amount, $id, $bonus_balance, $balance){
        //create row in pre-transactions to record a credit transaction of adding to the main balance
        $pre_transaction_credit = [];
        $pre_transaction_credit = [];
        $pre_transaction_credit['user_id'] = $id;
        $pre_transaction_credit['pre_transaction_id'] = TransactionIdGenerator::generate(20);
        $pre_transaction_credit['amount'] = $amount * 100;
        $pre_transaction_credit['description'] = "Amount Added to User Balance";
        $pre_transaction_credit['vendor'] = PreTransaction::MICROSERVICE_WALLET;
        $pre_transaction_credit['service_type'] = "Bonus Balance To Main Balance Transfer";
        $pre_transaction_credit['microservice_type'] = PreTransaction::MICROSERVICE_WALLET;
        $pre_transaction_credit['transaction_type'] = "credit";
        $pre_transaction_credit['url'] = "/bonusToMainBalanceTransfer";
        $pre_transaction_credit['status'] = "STARTED";
        $pre_transaction_credit['before_balance'] = $balance;
        $pre_transaction_credit['after_balance'] = $balance + ($amount * 100);
        $pre_transaction_credit['before_bonus_balance'] = $bonus_balance;
        $pre_transaction_credit['after_bonus_balance'] = $bonus_balance;

        return PreTransaction::create($pre_transaction_credit);
    }

    public function CreateBonusToMainBalanceTransfer($amount,$id, $description)
    {
        $bonus_to_main_balance_Transfer = [];
        $bonus_to_main_balance_Transfer['user_id'] = $id;
        $bonus_to_main_balance_Transfer['amount'] = $amount * 100;
        if ($description){
            $bonus_to_main_balance_Transfer['description'] = $description;
        }
        return MainBalanceAddition::create($bonus_to_main_balance_Transfer);
    }

    // create TransactionEvent for successful deduction of bonus balance

    public function CreateBonusBalanceDeductionTransactionEvent($amount,$id,$pre_transaction_id,$description,$transaction_id,$balance, $bonus_balance){
        $bonus_balance_deduction_transaction_event = [];
        $bonus_balance_deduction_transaction_event['pre_transaction_id'] = $pre_transaction_id;
        $bonus_balance_deduction_transaction_event['amount'] = $amount * 100;
        $bonus_balance_deduction_transaction_event['account'] = User::where('id','=',$id)->pluck('mobile_no')[0];
        $bonus_balance_deduction_transaction_event['description'] = $description;
        $bonus_balance_deduction_transaction_event['user_id'] = $id;
        $bonus_balance_deduction_transaction_event['transaction_id'] = $transaction_id; // transaction_id is bonus_to_main_balance_transfer table's ID
        $bonus_balance_deduction_transaction_event['transaction_type'] = "Bonus Balance Deduction";
        $bonus_balance_deduction_transaction_event['balance'] = $balance;
        $bonus_balance_deduction_transaction_event['bonus_balance'] = $bonus_balance;

        return TransactionEvent::create($bonus_balance_deduction_transaction_event);
    }

    public function DeductUserBonusBalance($balance,$bonus_balance,$before_balance,$before_bonus_balance,$userWallet)
    {
        $deduct_bonus_balance = [];
        $deduct_bonus_balance['balance'] = $balance;
        $deduct_bonus_balance['bonus_balance'] = $bonus_balance;
        $deduct_bonus_balance['before_balance'] = $before_balance;
        $deduct_bonus_balance['before_bonus_balance'] = $before_bonus_balance;
        return $userWallet->update($deduct_bonus_balance);
    }

    //create Transaction Event for the successful addition of balance

    public function CreateMainBalanceAdditionTransactionEvent($amount,$id,$pre_transaction_id,$description,$transaction_id,$balance, $bonus_balance){
        $main_balance_addition_transaction_event = [];
        $main_balance_addition_transaction_event['pre_transaction_id'] = $pre_transaction_id;
        $main_balance_addition_transaction_event['amount'] = $amount * 100;
        $main_balance_addition_transaction_event['account'] = User::where('id','=',$id)->pluck('mobile_no')[0];
        $main_balance_addition_transaction_event['description'] = $description;
        $main_balance_addition_transaction_event['user_id'] = $id;
        $main_balance_addition_transaction_event['transaction_id'] = $transaction_id; // transaction_id is bonus_to_main_balance_transfer table's ID
        $main_balance_addition_transaction_event['transaction_type'] = "Main Balance Addition";
        $main_balance_addition_transaction_event['balance'] = $balance;
        $main_balance_addition_transaction_event['bonus_balance'] = $bonus_balance;

        return TransactionEvent::create($main_balance_addition_transaction_event);
    }

    public function AddUserMainBalance($balance,$bonus_balance,$before_balance,$before_bonus_balance,$userWallet)
    {
        $add_main_balance = [];
        $add_main_balance['balance'] = $balance;
        $add_main_balance['bonus_balance'] = $bonus_balance;
        $add_main_balance['before_balance'] = $before_balance;
        $add_main_balance['before_bonus_balance'] = $before_bonus_balance;

        return $userWallet->update($add_main_balance);
    }
}
