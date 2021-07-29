<?php
namespace App\Filters\AgentTypeHierarchyCashbackFilter;

use App\Filters\FiltersAbstract;

class AgentTypeHierarchyCashbackFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'agent_type' => AgentTypeFilter::class
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
