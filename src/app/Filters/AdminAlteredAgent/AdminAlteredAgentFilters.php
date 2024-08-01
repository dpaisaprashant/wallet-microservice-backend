<?php
namespace App\Filters\AdminAlteredAgent;

use App\Filters\FiltersAbstract;

class AdminAlteredAgentFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'admin_name' => AdminNameFilter::class,
        'agent_number' => AgentNumFilter::class,
        'admin_action' => AdminActionFilter::class,
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
