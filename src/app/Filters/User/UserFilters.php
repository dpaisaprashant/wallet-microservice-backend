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
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'verification' => VerificationFilter::class,
        'referral_code' => ReferralFilter::class,
        'kyc_status' => KycFilter::class
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
