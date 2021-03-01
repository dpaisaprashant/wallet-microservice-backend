<?php

namespace App\Filters\EBanking;

use App\Filters\FiltersAbstract;

class EBankingFilters extends  FiltersAbstract {

    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'uid' => UIDFilter::class,
        'transaction_id' => IdFilter::class,
        'user' => UserFilter::class,
        'bank' => BankFilter::class,
        'amount' => AmountFilter::class,
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'status' => StatusFilter::class,
        'sort' => SortFilter::class,
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
