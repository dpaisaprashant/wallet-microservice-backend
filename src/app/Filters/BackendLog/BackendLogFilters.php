<?php
namespace App\Filters\BackendLog;

use App\Filters\FiltersAbstract;

class BackendLogFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'user' => UserFilter::class,
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'log_name' => LogNameFilter::class
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
