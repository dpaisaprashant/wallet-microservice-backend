<?php
namespace App\Filters\Agent;

use App\Filters\FiltersAbstract;

class AgentFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
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
