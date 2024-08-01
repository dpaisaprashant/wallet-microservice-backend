<?php
namespace App\Filters\NPSAccountLinkLoad;

use App\Filters\FiltersAbstract;

class NPSAccountLinkLoadFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'gateway_transaction_id' => GatewayTransactionIdFilter::class,
        'reference_id' => ReferenceIdFilter::class,
        'linked_accounts_id' => LinkedAccountsIdFilter::class,
        'merchant_txn_id' => MerchantTxnIdFilter::class,
        'load_status' => LoadStatusFilter::class,
        'latest_date' => LatestDateFilter::class,
        'from_load' => FromLoadDateFilter::class,
        'to_load' => ToLoadDateFilter::class,
        'from_amount' => AmountFrom::class,
        'to_amount' => AmountTo::class,
        'phone_number' => PhoneNumberFilter::class,
        
       
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