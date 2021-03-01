<?php
namespace App\Filters\FailedUserTransaction;

use App\Filters\FiltersAbstract;

class FailedUserTransactionFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'transaction_id' => IdFilter::class,
        'user' => UserFilter::class,
        'refStan' => RefStanFilter::class,
        'bill_no' => BillNoFilter::class,
        'code' => CodeFilter::class,
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class
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
