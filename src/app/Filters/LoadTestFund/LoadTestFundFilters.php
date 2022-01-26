<?php

namespace App\Filters\LoadTestFund;

use App\Filters\FiltersAbstract;

class LoadTestFundFilters extends  FiltersAbstract {

    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'description' => PaypointDescriptionFilter::class,
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
