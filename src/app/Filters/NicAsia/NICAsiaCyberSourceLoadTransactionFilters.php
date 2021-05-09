<?php

namespace App\Filters\NicAsia;

use App\Filters\FiltersAbstract;

class NICAsiaCyberSourceLoadTransactionFilters extends  FiltersAbstract {

    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'reference_number' => ReferenceNumberFilter::class,
        'pre_transaction_id' => PreTransactionIdFilter::class,
        'from_amount' => AmountFrom::class,
        'to_amount' => AmountTo::class,
        'transaction_id' => TransactionUID::class,
        'status' => Status::class,
//        'amount' => AmountFilter::class,
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
