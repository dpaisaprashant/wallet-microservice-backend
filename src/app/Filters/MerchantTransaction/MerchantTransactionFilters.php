<?php
namespace App\Filters\MerchantTransaction;

use App\Filters\FiltersAbstract;

class MerchantTransactionFilters extends FiltersAbstract
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
