<?php

namespace App\Filters\NchlAggregatedPayment;

use App\Filters\FiltersAbstract;

class NchlAggregatedPaymentFilters extends  FiltersAbstract {

    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'amount' => AmountFilter::class,
        'status' => StatusFilter::class,
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'transaction_id' => IdFilter::class,
        'sort' => SortFilter::class,
        'user' => UserFilter::class,
        'pre_transaction_id' => PreTransactionIdFilter::class,
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
