<?php
namespace App\Filters\UserTransaction;

use App\Filters\FiltersAbstract;

class UserTransactionFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'transaction_id' => IdFilter::class,
        'user' => UserFilter::class,
        'amount' => AmountFilter::class,
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'status' => StatusFilter::class,
        'sort' => SortFilter::class,
        'refStan' => RefStanFilter::class,
        'bill_no' => BillNoFilter::class,
        'vendor' => VendorFilter::class,
        'uid' => UIDFilter::class,
        'pre_transaction_id' => UserTransactionPreTransactionFilter::class
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
