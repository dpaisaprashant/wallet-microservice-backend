<?php
namespace App\Filters\Clearance;

use App\Filters\FiltersAbstract;

class ClearanceFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'transaction_count' => TransactionCountFilter::class,
        'total_transaction_amount' => TotalTransactionAmountFilter::class,
        'total_transaction_commission' => TotalTransactionCommissionFilter::class,
        'cleared_by' => ClearedByFilter::class,
        'transaction_date' => TransactionDateFilter::class,
        'clearance_date' => ClearanceDateFilter::class,
        'status' => StatusFilter::class,
        'sort' => SortFilter::class
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
