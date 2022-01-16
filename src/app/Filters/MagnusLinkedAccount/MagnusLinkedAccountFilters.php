<?php

namespace App\Filters\MagnusLinkedAccount;

use App\Filters\FiltersAbstract;

class MagnusLinkedAccountFilters extends FiltersAbstract
{

    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'date' => TxDateAdFilter::class,
        'status' => StatusFilter::class,
        'user' => UserFilter::class,
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
