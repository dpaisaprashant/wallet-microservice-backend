<?php

namespace App\Models;

use App\Filters\User\UserFilters;
use App\Models\Architecture\SingleUserCashback;
use App\Models\Architecture\SingleUserCommission;
use App\Models\BonusToMainBalanceTransfer\BonusBalanceDeduction;
use App\Models\BonusToMainBalanceTransfer\MainBalanceAddition;
use App\Models\Merchant\Merchant;
use App\Models\Microservice\PreTransaction;
use App\Models\Microservice\RequestInfo;
use App\Models\TransactionEvent;
use App\Traits\BelongsToPreTransaction;
use App\Traits\BelongsToRequestInfo;
use App\Wallet\Commission\Models\Commission;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable, LogsActivity;

    protected static $logFillable = true;
    protected static $logName = 'User';
    protected static $logOnlyDirty = true;


    protected $table = "users";
    protected $connection = 'dpaisa';

//    public function __construct(array $attributes = [])
//    {
//        $this->table = env('DB_DATABASE_2').'.'.$this->table;
//        parent::__construct();
//    }

    const AGENT = 'agent';

    const LOCK_MINUTES =  60;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'should_change_password', 'should_change_password_message'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new UserFilters($request))->add($filters)->filter($builder);
    }


    public function loginAttempts()
    {
        return $this->hasMany(UserLoginHistory::class);
    }

    public function latestLoginAttempt()
    {
        return $this->hasOne(UserLoginHistory::class)->latest();
    }

    public function activities()
    {
        return $this->hasMany(UserActivity::class);
    }

    public function loadTestFunds()
    {
        return $this->hasMany(LoadTestFund::class);
    }

    public function failedAttemptsCount(){

        return $this->loginAttempts()->where("status", 0)->where("created_at", ">", now()->subMinutes(self::LOCK_MINUTES))->count();
    }

    public function isLocked(){
        return $this->failedAttemptsCount() > 5;
    }


    public function userType()
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    /*public function merchantReseller(){
        return $this->hasOne(MerchantReseller::class,'user_id');
    }*/


    public function agentType()
    {
        if($this->isValidAgentOrSubAgent()){
            return optional(optional($this->agent)->agentType)->name;
        }
        return null;
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'user_id');
    }

    public function kyc()
    {
        return $this->hasOne(UserKYC::class, 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function userReferral()
    {
        return $this->hasOne(UserReferral::class);
    }

    public function userReferralBonus()
    {
        return $this->hasOne(UserReferralBonus::class);
    }

    public function userReferralLimit()
    {
        return $this->hasOne(UserReferralLimit::class);
    }

    public function userReferralBonusTransactions()
    {
        return $this->hasOne(UserReferralBonusTransaction::class);
    }

    public function agent()
    {
        return $this->hasOne(Agent::class,'user_id');
    }

    public function preTransactions(){
        return $this->hasMany(PreTransaction::class);
    }

    public function preTransaction(){
        return $this->hasMany(PreTransaction::class);
    }

    public function requestInfos()
    {
        return $this->hasMany(RequestInfo::class);
    }

    public function userLoadTransactions()
    {
        return $this->hasMany(UserLoadTransaction::class, 'user_id');
    }

    public function userCheckPayment()
    {
        return $this->hasMany(UserCheckPayment::class, 'user_id');
    }

    public function userExecutePayment()
    {
        return $this->hasMany(UserExecutePayment::class, 'user_id');
    }

    public function userTransactions()
    {
        return $this->hasMany(UserTransaction::class, 'user_id');
    }

    public function userLoginHistories()
    {
        return $this->hasMany(UserLoginHistory::class, 'user_id');
    }

    public function userTransactionEvents()
    {
        return $this->hasMany(TransactionEvent::class, 'user_id');
    }

    public function latestUserTransactionEvent()
    {
        return $this->hasOne(TransactionEvent::class,'user_id')->latest()->orderByDesc('id');
    }

    public function fromFundTransfers() {
        return $this->hasMany(UserToUserFundTransfer::class, 'from_user');
    }

    public function receiveFundTransfers() {
        return $this->hasMany(UserToUserFundTransfer::class, 'to_user');
    }

    public function fromFundRequests()
    {
        return $this->hasMany(FundRequest::class, 'from_user');
    }

    public function receiveFundRequests()
    {
        return $this->hasMany(FundRequest::class, 'to_user');
    }

    //referrals
    public function referralFrom()
    {
        return $this->hasMany(UsedUserReferral::class, 'referred_from');
    }

    public function referralTo()
    {
        return $this->hasMany(UsedUserReferral::class, 'referred_to');
    }

    public function merchantTransactions()
    {
        return $this->hasMany(MerchantTransaction::class, 'user_id');
    }

    public function merchantTransactionsMerchant()
    {
        return $this->hasMany(MerchantTransaction::class, 'merchant_id');
    }

    public function merchant()
    {
        return $this->hasOne(Merchant::class,'user_id');
    }


    public function nchlBankTransfers()
    {
        return $this->hasMany(NchlBankTransfer::class);
    }

    public function bankAccount()
    {
        return $this->hasOne(UserBankAccount::class, 'user_id');
    }

    public function nchlAggregatedPayments()
    {
        return $this->hasMany(NchlAggregatedPayment::class);
    }

    public function nchlLoadTransactions()
    {
        return $this->hasMany(NchlLoadTransaction::class);
    }

    public function nicAsiaCyberSourceTransactions()
    {
        return $this->hasMany(NICAsiaCyberSourceLoadTransaction::class);
    }

    public function FCMNotifications()
    {
        return $this->hasMany(FCMNotification::class, 'user_id');
    }

    //query
    public function userCashBack()
    {
        $cashBackIds = $this->userTransactionEvents()->whereServiceType('CASHBACK')->pluck('transaction_id');
        return Commission::with('transactions')->whereIn('id', $cashBackIds);
    }

    public function userCommission()
    {
        $commissionsId = $this->userTransactionEvents()->whereServiceType('COMMISSION')->pluck('transaction_id');
        return Commission::with('transactions')->whereIn('id', $commissionsId);
    }


    public function loadedFundSum()
    {
        //TODO: MICROSERVICE CHANGE
        return 0;
        return $this->userLoadTransactions()->whereStatus('COMPLETED')->sum('amount') / 100;
    }

    public function kycNotFilledUsers() {
        $kycFilledId = UserKYC::pluck('user_id')->all();
        return $this->with('wallet')->whereNotIn('id', $kycFilledId)->latest(); //50
    }

    public function userAcceptRejectKyc()
    {
        if (empty($this->kyc()->first())) {
            return null;
        }
        $kycId = $this->kyc()->first()->id;

        return AdminUserKYC::where('kyc_id', $kycId);
    }

    public function totalTransactionAmount(){
        return $this->userTransactionEvents()->sum("amount") / 100;
    }

    public function totalTransactionPaymentAmount(){
        return $this->userTransactionEvents()->where('transaction_type', 'App\Models\UserTransaction')->sum("amount") / 100;
    }

    public function totalLoadFundAmount()
    {
        return $this->userLoadTransactions()->sum("amount") / 100;
    }

    public function getTotalLoadedAmount()
    {
        //TODO: MICROSERVICE CHANGE
        return 0;
        //return $this->userLoadTransactions()->whereStatus('COMPLETED')->sum('amount') / 100;
    }

    public function getTotalPaymentAmount()
    {
       return $this->userTransactionEvents()->whereTransactionType('App\Models\UserTransaction')->sum('amount') / 100;
    }

    public function getFundSendAmount() //minus
    {
        $fundRequest = $this->receiveFundRequests()->whereStatus(1)->whereResponse(1)->sum('amount') / 100;
        $fundTransfer = $this->fromFundTransfers()->sum('amount') / 100;


        return ($fundRequest + $fundTransfer);
    }

    public function getFundReceiveAmount() //plus
    {
        $fundRequest = $this->fromFundRequests()->whereStatus(1)->whereResponse(1)->sum('amount') / 100;
        $fundTransfer = $this->receiveFundTransfers()->sum('amount') / 100;

        return ($fundRequest + $fundTransfer);
    }

    public function totalTransactionCount()
    {
        return $this->userTransactionEvents()->count();
    }

    public function totalReferralAmount()
    {
        return $this->userTransactionEvents()
                ->whereIn('transaction_type', [UsedUserReferral::class, UserReferralBonusTransaction::class])
                ->sum('amount') / 100;
    }

    //referred by user
    public function referredByUserId()
    {
        $referral =  UsedUserReferral::where('referred_to', $this->id)
            ->where('status', UsedUserReferral::STATUS_COMPLETE)
            ->first();
        if ($referral) {
            return $referral->referred_from;
        }
        return null;
    }

    public function referredByUser()
    {
        $referral =  UsedUserReferral::where('referred_to', $this->id)
            //->where('status', UsedUserReferral::STATUS_COMPLETE)
            ->first();
        if ($referral) {
            return User::with('wallet', 'userReferralBonus')->where('id', $referral->referred_from)->first();
        }
        return null;
    }

    public function referredCompleteByUser()
    {
        $referral =  UsedUserReferral::where('referred_to', $this->id)
            ->where('status', UsedUserReferral::STATUS_COMPLETE)
            ->first();
        if ($referral) {
            return User::with('wallet', 'userReferralBonus')->where('id', $referral->referred_from)->first();
        }
        return null;
    }

    public function registerReferral()
    {
        return $referral =  UsedUserReferral::where('referred_to', $this->id)
            ->orWhere('referred_from', $this->id)
            //->where('status', UsedUserReferral::STATUS_COMPLETE)
            ->first();
    }

    public function getKYCStatus()
    {
        $status = 'not available';
        if(empty($this->kyc)) {
            $status =  'not filled';
        } elseif($this->kyc->status == 0 && $this->kyc->accept !== 0) {
            $status =  'not verified';
        } elseif($this->kyc->status == 0 && $this->kyc->accept === 0) {
            $status =  'kyc rejected';
        } elseif($this->kyc->status == 1) {
            $status =  'verified';
        }
        return $status;
    }

    public function getTotalCashBack()
    {
        return $this->userTransactionEvents()->where('service_type', 'CASHBACK')->sum('amount') / 100;
    }

    //agents
    public function isAgent()
    {
        if ($this->agent) {
            if ($this->agent->code_used_id) {
                return false;
            }
            return true;
        }

        return false;

    }

    public function isSubAgent()
    {
        if ($this->agent) {
            if ($this->agent->code_used_id) {
                return true;
            }
        }

        return false;
    }

    public function isValidAgentOrSubAgent()
    {
        if ($this->agentStatus() == Agent::STATUS_ACCEPTED) {
            return true;
        }
        return false;
    }


    public function agentStatus()
    {
        return optional($this->agent)->status;
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

    public function issueTicket()
    {
        return $this->setConnection('mysql')->hasMany(IssueTicket::class, 'user_id', 'id');
    }

    public function mainBalanceDeduction()
    {
        return $this->hasMany(MainBalanceAddition::class);
    }

    public function bonusBalanceDeduction()
    {
        return $this->hasMany(BonusBalanceDeduction::class);
    }


}
