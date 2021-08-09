<?php
namespace App\Filters\LinkedAccounts;

use App\Filters\FiltersAbstract;

class LinkedAccountsFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'account_name' => AccountNameFilter::class,
        'account_number' => AccountNumberFilter::class,
        'bank_code' => BankCodeFilter::class,
        'reference_id' => ReferenceIdFilter::class,
        'verified_status' => VerifiedStatusFilter::class,
        'register_status' => RegisterStatusFilter::class,
        'user_id' => UserIdFilter::class,
        'mobile_number' => PhoneNumberFilter::class,
        'user_phone_number' => UserPhoneNumberFilter::class,
        
    ];


    /**
     * Mappings for course filter values.
     *
     * @return array
     */
    public static function mapping() {
        $map = [
            'sort' => [
                'date' => 'created_at',
            ]
        ];

        return  $map;
    }
}