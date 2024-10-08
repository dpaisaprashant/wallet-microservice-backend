<?php
namespace App\Filters\User;

use App\Filters\FiltersAbstract;

class UserFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'name' => NameFilter::class,
        'number' => ContactNumberFilter::class,
        'user' => UserFilter::class,
        'email' => EmailFilter::class,
        'wallet_balance' => WalletFilter::class,
        'transaction_number' => TransactionNumberFilter::class,
        'transaction_payment' => TransactionPaymentFilter::class,
        'transaction_loaded' => TransactionLoadedFilter::class,
        'sort' => SortFilter::class,
//        'sortTot' => SortTransactionTotalFilter::class,
        'from' => FromDateFilter::class,
        'from_agent_created_at' => FromAgentDateFilter::class,
        'to_agent_created_at' => ToAgentDateFilter::class,
        'to' => ToDateFilter::class,
        'verification' => VerificationFilter::class,
        'referral_code' => ReferralFilter::class,
        'kyc_status' => KycFilter::class,
        'user_name' =>MismatchUserFilter::class,
        'mobile_no'=>MismatchUserNumberFilter::class,
        'parent_agent'=>ParentAgentFilter::class,
        'agent_number_email'=>AgentNumberEmailFilter::class,
        'parent_agent_number_email'=>ParentAgentNumberEmailFilter::class,
        'agent_status'=>AgentStatusFilter::class,
        'merchant_type' => MerchantTypeFilter::class,
        'user_type' => UserTypeFilter::class,
        'user_activity_status' => UserActivityStatusFilter::class,
        'from_transaction_date' => FromTransactionDateFilter::class,
        'to_transaction_date' => ToTransactionDateFilter::class,
        'from_kyc_date' => FromKYCDateFilter::class,
        'to_kyc_date' => ToKYCDateFilter::class,
        'district'=> DistrictFilter::class,
        'user_only'=>UserOnlyFilter::class,
        'merchant_only'=>MerchantOnlyFilter::class,
        'user_status' => UserStatusFilter::class,
        'locked_users' => LockedUsersFilter::class,
        'registered_using_referral' => RegisterUsingReferralFilter::class,
    ];


    /**
     * Mappings for course filter values.
     *
     * @return array
     */
    public static function mapping() {
        $map = [

        ];

        return  $map;
    }
}
