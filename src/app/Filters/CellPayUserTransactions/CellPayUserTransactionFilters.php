<?php
namespace App\Filters\CellPayUserTransactions;

use App\Filters\FiltersAbstract;

class CellPayUserTransactionFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'account' => accountFilter::class,
        'vendor'=>vendorFilter::class,
        'status'=>statusFilter::class,
        'service_type' => serviceTypeFilter::class,
        'from_amount' => fromAmountFilter::class,
        'reference_number'=>referenceNumberFilter::class,
        'user_number'=>userNumberFilter::class,
        'to_amount' => toAmountFilter::class,
        'from' => fromDateFilter::class,
        'to' => toDateFilter::class,
//        'sort'=>SortFilter::class,
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
