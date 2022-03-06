<?php

namespace App\Wallet\UserProfile\Http;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminUserKYC;
use App\Models\NICAsiaCyberSourceLoadTransaction;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\UserBonus;
use App\Models\UserCommissionValue;
use App\Models\UserKYC;
use App\Models\UserLoadTransaction;
use App\Models\Wallet;
use App\Traits\CollectionPaginate;
use App\Wallet\AuditTrail\AuditTrial;
use App\Wallet\AuditTrail\Behaviors\BAll;
use App\Wallet\AuditTrail\Behaviors\BLoginHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    use CollectionPaginate;

    private function loginHistoryAudits($user)
    {
        $IBehaviour = new BLoginHistory();
        $auditTrial = new AuditTrial($IBehaviour);
        return $auditTrial->createTrial($user);
    }

    private function allAudits($user, $request)
    {
        $IBehaviour = new BAll(); //get audit data from all transactions/user activity tables
        $auditTrial = new AuditTrial($IBehaviour);
        return $this->collectionPaginate(50, $auditTrial->setRequest($request)->createTrial($user), $request, 'all-audit-trials');
    }

    public function userProfile($id, Request $request){

        $length = 15;
        $activeTab = 'kyc';
        if ($request->has('user-load-fund') || $request->transaction_type === 'user-load-fund') {
            $activeTab = 'loadFund';
        }
        if ($request->has('user-transaction-event') || $request->transaction_type === 'user-transaction-event') {
            $activeTab = 'transaction';
        }
        if ($request->has('all-audit-trials') || $request->transaction_type === 'all-audit-trials') {
            $activeTab = 'allAuditTrial';
        }

        if ($request->has('user-login-history-audit') || $request->transaction_type === 'user-login-history-audit') {
            $activeTab = 'userLoginHistoryAudit';
        }


        //$user = User::with(['userLoadTransactions', 'userLoginHistories', 'userCheckPayment', 'fromFundTransfers', 'receiveFundTransfers', 'fromFundRequests', 'receiveFundRequests', 'kyc', 'wallet'])->findOrFail($id);
        $user = User::with(['userReferral', 'userReferralLimit', 'merchant', 'bankAccount', 'preTransactions', 'requestInfos', 'userLoginHistories', 'fromFundTransfers', 'receiveFundTransfers', 'fromFundRequests', 'receiveFundRequests', 'kyc', 'wallet', 'agent', 'userReferralBonus'])->findOrFail($id);
        $userBonus = UserBonus::whereHas('user')->where('user_id', $id)->first()->bonus;
        $userBonusBalance = Wallet::whereHas('user')->where('user_id', $id)->first()->bonus_balance;
        $admin = $request->user();
        if (!$admin->hasPermissionTo('User profile')) {

            //merchant
            if ($user->merchant) {
                if (!$admin->hasPermissionTo('Merchant profile')) {
                    abort(403, 'User does not have the right permissions to view merchant profile.');
                }
            }

            //agent
            if ($user->agent) { //has row in agents table but is a verified agent
                if (!$admin->hasPermissionTo('View agent profile')) {
                    abort(403, 'User does not have the right permissions to view agent profile');
                }
            }

            //normal user
            if (empty($user->agent) && empty($user->merchant)) {
                abort(403, 'User does not have the right permissions to view user profile');
            }
        }

        //Audit Trial section
        $allAudits = $this->allAudits($user, $request);
        //$nPayAudits = $this->nPayAudits($user);
        // $payPointAudits = $this->payPointAudits($user);
        $loginHistoryAudits = $this->loginHistoryAudits($user);

        //$userLoadTransactions = UserLoadTransaction::with('commission')->where('user_id', $user->id)->where('status', 'COMPLETED')->latest()->filter($request)->paginate($length,['*'], 'user-load-fund');
        $loadPTIds = TransactionEvent::where('transaction_type', UserLoadTransaction::class)->where('user_id', $user->id)->pluck('pre_transaction_id');
        $userTransactionEvents = TransactionEvent::where('user_id', $user->id)->latest()->filter($request)->paginate($length, ['*'], 'user-transaction-event');
        $userTransactionStatements = TransactionEvent::where('user_id', $user->id)->latest()->filter($request)->paginate($length, ['*'], 'user-transaction-statement');
        $loadFundSum = $user->loadedFundSum();
        $userLoadCommission = (new UserCommissionValue())->getUserCommission($user->id, NICAsiaCyberSourceLoadTransaction::class);
        $user_id = UserKYC::where('user_id', $id)->first();

        if ($user_id != null) {
            $ids = $user_id->id;
            $admin = AdminUserKYC::where('kyc_id', $ids)->orderBy('created_at', 'DESC')->first();
            $admin_id = optional($admin)->admin_id;
            $admin_details = Admin::where('id', $admin_id)->first();
        } else {
            $admin_details = collect(array('nodata'));
            $admin = collect(array('nodata'));
            $admin_data = collect(array('nodata'));
        }
        return view('UserProfile::user_profile')->with(compact('userLoadCommission', 'admin_details', 'admin', 'loginHistoryAudits', 'allAudits', 'user', 'loadFundSum', 'activeTab', 'userTransactionStatements', 'userTransactionEvents', 'userBonus', 'userBonusBalance'));
    }

    public function userKyc($id){
        $user = User::with('kyc')->findOrFail($id);
        $user_id = UserKYC::where('user_id', $id)->first();

        if ($user_id != null) {
            $ids = $user_id->id;
            $admin = AdminUserKYC::where('kyc_id', $ids)->orderBy('created_at', 'DESC')->first();
            $admin_id = optional($admin)->admin_id;
            $admin_details = Admin::where('id', $admin_id)->first();
        } else {
            $admin_details = collect(array('nodata'));
            $admin = collect(array('nodata'));
            $admin_data = collect(array('nodata'));
        }

        return view("UserProfile::kyc")->with(compact('admin_details', 'user'));
//        return [$user,$admin_details];

    }

    public function userAuditTrail($wallet, $id)
    {
//        $db_name = '';
//        if ($wallet == 'sajilopay') {
//            $db_name = 'mysql_sajilo';
//        } else if ($wallet == 'dpaisa') {
//            $db_name = 'mysql_core';
//        } else {
//            echo "Unrecognized wallet";
//            return null;
//        }

        $db_name = 'dpaisa';
        $text = 'I am going to do it. I have made up my mind. These are the first few words of the new… the best … the Longest Text In The Entire History Of The Known Universe! This Has To Have Over 35,000 words the beat the current world record set by that person who made that flaming chicken handbooky thingy. I might just be saying random things the whole time I type in this so you might get confused a lot. I just discovered something terrible. autocorrect is on!! no!!! this has to be crazy, so I will have to break all the English language rules and the basic knowledge of the average human being. I am not an average human being, however I am special. no no no, not THAT kind of special ;). Why do people send that wink face! it always gives me nightmares! it can make a completely normal sentence creepy. imagine you are going to a friend’s house, so you text this: [ see you soon 🙂 ] seems normal, right? But what is you add the word semi to that colon? (Is that right? or is it the other way around) what is you add a lorry to that briquettes? (Semi-truck to that coal-on) anyway, back to the point: [ see you soon 😉 ]THAT IS JUST SO CREEPY! is that really your friend, or is it a creepy stalker watching your every move? Or even worse, is it your friend who is a creepy stalker? maybe you thought it was your friend, but it was actually your fri end (let me explain: you are happily in McDonalds, getting fat while eating yummy food and some random dude walks up and blots out the sun (he looks like a regular here) you can’t see anything else than him, so you can’t try to avoid eye contact. he finishes eating his cheeseburger (more like horseburgher(I learned that word from the merchant of Venice(which is a good play(if you can understand it(I can cause I got a special book with all the words in readable English written on the side of the page(which is kinda funny because Shakespeare was supposed to be a good poet but no-one can understand him(and he’s racist in act 2 scene1 of the play too))))))) and sits down beside you , like you are old pals (you’ve never met him before but he looks like he could be in some weird cult) he clears his throat and asks you a very personal question. “can i have some French fries?” (I don’t know why there called French fries when I’ve never seen a French person eat fries! all they eat it is stuff like baguettes and crêpes and rats named ratty-two-ee which is a really fun game on the PlayStation 2) And you think {bubbly cloud thinking bubble} “Hahahahahhahahahahahahahaha!!!!!!!!!!!! Hehheheheheh…..heeeheehe..hehe… sigh. I remember that i was just about to eat one of my fries when I noticed something mushy and moist and [insert gross color like green or brown] on the end of one of my fries! now I can give it to this NERD!! ” (yes he is a nerd because all he does all day is watch the extended editions of the hobbit, lord of the rings and star wars and eat fat cakes (what the heck is a fat cake? I think it might be like a Twinkie or something)and twinkies(wow so is doesn’t really matter which is which because he eats both(i may have just done that so I didn’t have to Google what a fat cake is (right now I am typing on my iPhone 3gs anyway, which has a broken antenna so i can’t get internet anyway (it’s actually a really funny story that i’ll tell you sometime)))and sit in his man cave with his friend named Joe (an ACTUAL friend, not a fri end)and all Joe does is watch sports like football with bob and all bob does is gamble ferociously (don’t ask(it means he buys all those bags of chips that say “win a free monkey or something if you find a banana in your bag*”(if there is a little star it means there is fine print so I always check the back of the package) *flips over the package* okay, it says: “one of our workers accidentally threw a banana in the packing machine and we don’t want to get sued so we did this promotion thing” cool. Oh wow, this is salt and vinegar! my favourite! i hate cheese and onion.))and that’s pretty much his life, he lives in Jamaica with Naruto and his friends) so you give him that gross fri end he throws up all over you and me and the worker behind the counter who was still making an onion, and THAT is the story of the fri end, not a friend who somehow remembered your name and your phone number / email so he could text you saying he would come to your house soon. *finally takes a breath after typing a few hundred words about fri-ends* so what now? i know, i know, you think i ramble too much and use too many brackets (i don’t) but now i am going to talk about my amAZEing day. first i woke up, ate choco pops for breakfast even tho i always hate it when people say that cause i get jealous and super hungry. then i… umm… yea! that was my day. you know that other person i mentioned before? that flaming chicken person? WELL. i will steal something from that person but do it better. i will… drum roll please …';
        DB::connection($db_name)->select(DB::raw(
            "
            CREATE TEMPORARY TABLE temp_audit
            SELECT
            pre_transaction_id,
            vendor,
            service_type,
            account_type,
            IFNULL(commissionable_id, 0) as commissionable_id,
            amount/100 as amount,
            balance/100 as balance,
            bonus_balance/100 as bonus_balance,
            created_at,
            'SUCCESS' as status,
            :text as json_response,
            0 as refund_id
            FROM `transaction_events`
            where user_id = :user_id order by created_at desc
            "
        ), array(
            'user_id' => $id,
            'text' => $text
        ));

        // DB::connection($db_name)->select(DB::raw("
        //     INSERT INTO temp_audit
        //     SELECT
        //     pre_transaction_id,
        //     vendor,
        //     service_type,
        //     transaction_type as account_type,
        //     '0' as commissionable_id,
        //     amount/100 as amount,
        //     after_balance/100 as balance,
        //     after_bonus_balance/100 as bonus_balance,
        //     (updated_at) as created_at,
        //     status,
        //     json_response,
        //     IFNULL(refund_id, 0) as refund_id
        //     FROM `pre_transactions` where user_id = :user_id and status != 'SUCCESS'
        // "), array(
        //     'user_id' => $id,
        // ));
        $user_details = DB::connection($db_name)
            ->select(DB::raw(
                "select * from users as u join wallets as w on u.id = w.user_id where u.id = :user_id"
            ), array('user_id' => $id));

        $display = DB::connection($db_name)->select(DB::raw("SELECT * from temp_audit order by created_at asc"));
        $sum = DB::connection($db_name)->select(DB::raw("
        SELECT
        SUM(CASE WHEN account_type = 'debit' THEN amount/100 END) as debit_total,
        SUM(CASE WHEN account_type = 'credit' THEN  amount/100 END) as credit_total
        from transaction_events where user_id = :user_id
        and
        (
        service_type != 'REFUND'
        AND
        refund_id IS NULL
        )
        "), array("user_id" => $id));

        $data = array(
            "audit" => $display,
            "user" => $user_details,
            "sum" => $sum
        );

        return view('UserProfile::audit_trial')->with('data', $data);
    }

}
