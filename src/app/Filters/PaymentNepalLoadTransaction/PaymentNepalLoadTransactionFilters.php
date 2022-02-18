<?php
namespace App\Filters\PaymentNepalLoadTransaction;

use App\Filters\FiltersAbstract;

class PaymentNepalLoadTransactionFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
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
            ]
        ];

        return  $map;
    }
}
