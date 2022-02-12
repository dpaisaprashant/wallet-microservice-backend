<?php

namespace App\Filters\BFI;

use App\Filters\FiltersAbstract;

class BFIFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'transaction_id' => TransactionIdFilter::class,
        'user' => UserFilter::class,
        'process_id' => ProcessIdFilter::class,
        'status' => StatusFilter::class,
        'from_amount' => FromAmountFilter::class,
        'to_amount' => ToAmountFilter::class
    ];


    /**
     * Mappings for course filter values.
     *
     * @return array
     */
    public static function mapping()
    {
        $map = [
            'sort' => [
                'date' => 'created_at',
            ]
        ];

        return $map;
    }
}
