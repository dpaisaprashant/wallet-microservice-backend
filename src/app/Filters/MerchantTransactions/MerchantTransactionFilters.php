<?php
namespace App\Filters\MerchantTransactions;

use App\Filters\FiltersAbstract;

class MerchantTransactionFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'transaction_id' => TransactionIdFilter::class,
        'user_id' => UserFilter::class,
        'vendor' => VendorFilter::class,
        'service_type' => ServiceFilter::class,
        'amount' => AmountFilter::class,
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'sort' => SortFilter::class,
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
                'amount' => 'amount'
            ]
        ];

        return  $map;
    }
}
