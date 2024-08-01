<?php
namespace App\Filters\MiracleInfo;

use App\Filters\FiltersAbstract;

class MiracleInfoFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'mobile_no' => MobileNoFilter::class,
        'sort' => SortFilter::class,
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class
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
