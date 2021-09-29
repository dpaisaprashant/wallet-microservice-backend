<?php

namespace App\Filters\NPS;

use App\Filters\FiltersAbstract;

class NpsFilters extends  FiltersAbstract {

    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'uid' => NpsUIDFilter::class,
        'transaction_id' => NpsTransactionIdFilter::class,
        'bank' => NpsBankFilter::class,
        'status' => NpsStatusFilter::class,
        'sort' => NpsSortFilter::class,
        'from' => NpsFromDateFilter::class,
        'to' => NpsToDateFilter::class,
        'from_amount' => NpsFromAmount::class,
        'to_amount' => NpsToAmount::class,
        'user' => NpsUserFilter::class,
        'pre_transaction_id' => NpsPreTransactionFilter::class,
        'gateway_ref' => GateWayRefFilter::class
    ];

    /**
     * Mappings for course filter values.
     *
     * @return array
     */
    public static function mapping() {
        $map = [
            'status' => [
                'completed' => 'COMPLETED',
                'validates' => 'VALIDATED'
            ],
            'sort' => [
                'date' => 'created_at',
                'amount' => 'amount'
            ]
        ];

        return  $map;
    }
}
