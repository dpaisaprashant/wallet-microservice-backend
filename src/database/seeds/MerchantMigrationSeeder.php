<?php

use App\Models\Admin;
use App\Models\UserKYC;
use App\Models\UserKYCValidation;
use App\Wallet\Helpers\TransactionIdGenerator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class MerchantMigrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $coreDB = DB::connection("dpaisa");
        $merchantDB = DB::connection("merchant");

        //key => old number
        //value => new number
        $merchantNumbers = [
            "9860089363" => "9841938311"
        ];


        foreach ($merchantNumbers as $oldNumber => $newNumber) {

            //1
            //check if new number already exists in user's table
            //create new row in users table
            //create wallet
            //create referral
            //create bonus

            $numberAlreadyExists = $coreDB->table("users")->where("mobile_no", $newNumber)->count();
            if ($numberAlreadyExists) {
                Log::info("==================================================================================");
                Log::info("Number already exists");
                Log::info("Old Number: " . $oldNumber);
                Log::info("New Number: ". $newNumber);
                Log::info("==================================================================================");
            }

            $merchant = $merchantDB->table("merchants")->where("mobile_no", $oldNumber)->first();
            if (empty($merchant)) {
                Log::info("==================================================================================");
                Log::info("Merchant not found");
                Log::info("Number: " . $oldNumber);
                Log::info("==================================================================================");
            }

            $createNewUserData = [
                "name" => $merchant->name,
                "email" => $merchant->email ?? null,
                "email_verified_at" => $merchant->email_verified_at,
                "mobile_no" => $newNumber,
                "fcm_token" => $merchant->fcm_token,
                "password" => $merchant->password,
                "status" => $merchant->status,
                "remember_token" => $merchant->remember_token,
                "created_at" => $merchant->created_at,
                "updated_at" => $merchant->updated_at,
                "desktop_fcm" => $merchant->desktop_fcm,
                "phone_verified_at" => $merchant->phone_verified_at,
                "user_type_id" => 0,
                "gender" => $merchant->gender ?? null
            ];

            $coreDB->table("users")->insert($createNewUserData);
            $user = $coreDB->table("users")->where("mobile_no", $newNumber)->first();

            if (empty($user)) {
                Log::info("==================== ERROR WHILE CREATING USER ===================================");
                Log::info("Old Number: " . $oldNumber);
                Log::info("Create new user data", $createNewUserData);
            }

            $coreDB->table("wallets")->insert([
                "user_id" => $user->id,
                "balance" => 0,
                "created_at" => $merchant->created_at,
                "updated_at" => $merchant->updated_at,
                "bonus_balance" => $merchant->bonus_balance,
                "before_balance" => $merchant->before_bonus_balance
            ]);

            $coreDB->table("user_referrals")->insert([
                "user_id" => $user->id,
                "code" => TransactionIdGenerator::generateReferral(),
                "created_at" => $merchant->created_at,
                "updated-at" => $merchant->updated_at
            ]);

            $coreDB->table("user_bonuses")->insert([
                "user_id" => $user->id,
                "bonus" => 0,
                "created_at" => $merchant->created_at,
                "updated_at" => $merchant->updated_at
            ]);

            //1.5. Transfer merchant kyc to user kyc
            $merchantKyc = $merchantDB->table("merchant_k_y_c_s")
                ->where("merchant_id", $merchant->id)
                ->first()
                ->toArray();

            if ($merchantKyc) {
                unset($merchantKyc["merchant_id"]);
                $merchantKyc["user_id"] = $user->id;
                $coreDB->table("user_k_y_c_s")->insert($merchantKyc);
            }

            //2
            //migrate merchant_transactions table
            //migrate merchant_ticket_payments table
            //change merchant id to new user id for the table
            $coreDB->table("merchants")->where("id", $merchant->id)
                ->update(["user_id" => $user->id, "merchant_type_id" => 1]);

            $coreDB->table("merchant_transactions")->where("merchant_id", $merchant->id)
                ->update(["merchant_id" => "user_id"]);


            $coreDB->table("merchant_transactions")->where("merchant_id", $merchant->id)
                ->update(["merchant_id" => "user_id"]);

            //TODO: MERCHANT TICKET PAYMENT
            $merchantTransactionEvents = $coreDB->table("merchant_transaction_events")
                ->where("merchant_id", $merchant->id)
                ->get();


            //3
            //move row from merchant_transaction_events table to transaction_events table
            foreach ($merchantTransactionEvents as $merchantTransactionEvent) {
                $merchantTransactionEvent = $merchantTransactionEvent->toArray();
                unset($merchantTransactionEvent["merchant_id"], $merchantTransactionEvent["id"]);
                $merchantTransactionEvent["user_id"] = $user->id;
                $coreDB->table("transaction_events")->insert($merchantTransactionEvent);
            }

            //4
            //update user balance
            $oldWallet = $coreDB->table("merchant_wallets")
                ->where("merchant_id", $merchant->id)
                ->first();


            $newWallet = $coreDB->table("wallets")
                ->where("user_id", $user->id)
                ->update([
                    "balance" => $oldWallet->balance,
                    "bonus_balance" => $oldWallet->bonus_balance ?? 0,
                    "created_at" => $oldWallet->created_at,
                    "updated_at" => $oldWallet->updated_at
                ]);
        }
    }
}
