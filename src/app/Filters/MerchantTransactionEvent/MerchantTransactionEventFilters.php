<?php
namespace App\Filters\MerchantTransactionEvent;

use App\Filters\FiltersAbstract;

class MerchantTransactionEventFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'uid' => UIDFilter::class,
        'account' => AccountFilter::class,
        'vendor' => VendorFilter::class,
        'service' => ServiceFilter::class,
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
