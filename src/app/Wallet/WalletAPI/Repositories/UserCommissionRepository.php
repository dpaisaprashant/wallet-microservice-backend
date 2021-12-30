<?php


namespace App\Wallet\WalletAPI\Repositories;


use App\Models\AgentType;
use App\Models\Architecture\SingleUserCommission;
use App\Models\Architecture\WalletTransactionType;
use App\Models\Architecture\WalletTransactionTypeCommission;
use App\Models\User;
use App\Models\UserType;
use App\Wallet\WalletAPI\Repositories\WalletTransactionTypeRepository;
use App\Wallet\Architecture\CashbackAndCommission\Resolver\CommissionResolver;
use App\Wallet\Architecture\CashbackAndCommission\Resolver\SlabRateResolver;
use App\Wallet\Traits\CommissionCalculator;
use Illuminate\Support\Facades\Log;

class UserCommissionRepository
{
    use CommissionCalculator;

    protected $user;

    protected $userType;

    protected $userTypeId;

    protected $commissions;


    public function __construct(User $user)
    {
        $this->user = $user;
        $this->resolveUserTypeAndUserTypeId();
        $this->commissions = $this->getCommissions();
    }

    private function resolveUserTypeAndUserTypeId()
    {
        $user = $this->user;
        $userType = UserType::class;
        $userTypeId = $user->user_type_id;
        $userModel = User::class;

        if ($user->isValidAgentOrSubAgent()) {
            $userTypeId = $user->agent->agent_type_id;
            $userType = AgentType::class;
        }

        $this->userType = $userType;
        $this->userTypeId = $userTypeId;
    }

    public function getCommissions()
    {
        $commonUserCommissionsIds = SingleUserCommission::where('user_id', $this->user->id)
            ->where('user_type', User::class)
            ->pluck('wallet_transaction_type_id')
            ->toArray();

        $transactionCommissions = (new WalletTransactionTypeCommission())->getCurrentUserCommissionBuilder($this->userTypeId, $this->userType)
            ->whereNotIn('wallet_transaction_type_id', $commonUserCommissionsIds)
            ->get();

        $userCommissions = (new SingleUserCommission())->getCurrentUserCommissionBuilder($this->user->id, User::class)
            ->get();

        $commissions = $transactionCommissions->concat($userCommissions);


        /*if ($this->userType == AgentType::class) {
            //get commission of userType only fore those commission  which do not have agent Type cashback
            $agentTypeCashbackIds = $transactionCommissions->map(function ($value, $key) {
                return $value->id;
            });

            $normalUserTypeId = $this->user->user_type_id;
            $userTypeCommissions = (new WalletTransactionTypeCommission())->getCurrentUserCommissionBuilder($normalUserTypeId, UserType::class)
                ->whereNotIn('wallet_transaction_type_id', $agentTypeCashbackIds)
                ->get();

            $commissions = $commissions->concat($userTypeCommissions);
        }*/

        return $commissions;
    }

    public function getBankTransferCommission()
    {
        $commissions = $this->commissions;
        //get bank transfer transaction type id
        $walletTransactionTypeRepository = new WalletTransactionTypeRepository();
        $bankTransferIds = $walletTransactionTypeRepository->bankTransferIds();

        $bankCommissions = $commissions->map(function ($value, $key) use ($bankTransferIds){
            if (in_array($value->wallet_transaction_type_id, $bankTransferIds)) {
                return [
                    'from' => $value->slab_from,
                    'to' => $value->slab_to,
                    'type' => $value->commission_type,
                    'amount' => $value->commission_value,
                ];
            }
        })->filter()->values();

        return $bankCommissions;
    }

    public function getCardLoadCommission()
    {
        $commissions = $this->commissions;
        //get bank transfer transaction type id
        $walletTransactionTypeRepository = new WalletTransactionTypeRepository();
        #$cardLoad = $walletTransactionTypeRepository->cybersourceCardLoadTransactionType();
        $cardLoad = $walletTransactionTypeRepository->paymentNepalCardLoadTransactionType();

        $cardCommission = $commissions->map(function ($value, $key) use ($cardLoad){

            if ($value->wallet_transaction_type_id == $cardLoad->id) {
                return [
                    'from' => $value->slab_from,
                    'to' => $value->slab_to,
                    'type' => $value->commission_type,
                    'value' => $value->commission_value,
                ];
            }
        });

        $returnCommission = $cardCommission->filter()->values();
        if (isset($returnCommission[0])) {
            return $returnCommission[0];
        }

       return [
           'from' => null,
           'to' => null,
           'type' => null,
           'value' => null,
       ];
    }

    public function getTransactionCommission($amount, WalletTransactionType $walletTransactionType)
    {
        $commission = $this->resolveCommissionValues($this->user, $amount, $walletTransactionType);
        if (optional($commission)->commission_value)
            return $this->calculateCommissionInPaisa($commission->commission_type, $amount, $commission->commission_value);

        return 0;
    }

    private function resolveSlabCommissions($amount, $cashbackBuilder)
    {
        $resolver = new SlabRateResolver($amount, $cashbackBuilder);
        return $resolver->resolveSlabRate();
    }

    public function resolveCommissionValues($user, $amount, $walletTransactionType)
    {
        $userTypeId = $user->user_type_id;
        $userType = UserType::class;
        //set user types as agent
        if ($user->isValidAgentOrSubAgent()) {
            $userTypeId = $user->agent->agent_type_id;
            $userType = AgentType::class;
        }

        //set user types as merchant
        if ($user->isMerchant()) {
            $userTypeId = $user->merchant->merchant_type_id;
            $userType = UserType::class;
        }

        //check single users table
        $singleUserCommissionBuilder = (new SingleUserCommission())->resolveCommissionBuilder(
            $walletTransactionType->id,
            $user->id,
            User::class
        );

        $singleUserCommission = $this->resolveSlabCommissions($amount, $singleUserCommissionBuilder);
        if ($singleUserCommission) return $singleUserCommission;


        //check wallet transaction type table
        $walletTransactionTypeCommissionBuilder = (new WalletTransactionTypeCommission())->resolveCommissionBuilder(
            $walletTransactionType->id,
            $userTypeId,
            $userType
        );

        //slab commissions
        $walletTransactionTypeCommission = $this->resolveSlabCommissions($amount, $walletTransactionTypeCommissionBuilder);
        if ($walletTransactionTypeCommission) return $walletTransactionTypeCommission;

        //apply commission of user type for agent if cashback not found
        if ($userType == AgentType::class) {
            $userTypeId = $user->user_type_id;
            $userType = UserType::class;

            $walletTransactionTypeCommissionBuilder = (new WalletTransactionTypeCommission())->resolveCommissionBuilder(
                $walletTransactionType->id,
                $userTypeId,
                $userType
            );

            //slab commissions
            $walletTransactionTypeCommission = $this->resolveSlabCommissions($amount, $walletTransactionTypeCommissionBuilder);
            if ($walletTransactionTypeCommission) return $walletTransactionTypeCommission;
        }

        return null;
    }
}
