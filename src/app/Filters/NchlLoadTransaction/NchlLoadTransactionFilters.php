<?php

namespace App\Filters\NchlLoadTransaction;

use App\Filters\FiltersAbstract;

class NchlLoadTransactionFilters extends  FiltersAbstract {

    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'amount' => AmountFilter::class,
        'transaction_id' => IdFilter::class,
        'reference_id' => ReferenceIdFilter::class,
        'user' => UserFilter::class,
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
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
