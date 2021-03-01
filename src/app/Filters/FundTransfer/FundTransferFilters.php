<?php

namespace App\Filters\FundTransfer;

use App\Filters\FiltersAbstract;

class FundTransferFilters extends  FiltersAbstract {

    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'from_user' => FromUserFilter::class,
        'to_user' => ToUserFilter::class,
        'fund' => AmountFilter::class,
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'sort' => SortFilter::class
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
