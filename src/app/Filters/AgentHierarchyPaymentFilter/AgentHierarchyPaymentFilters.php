<?php
namespace App\Filters\AgentHierarchyPaymentFilter;

use App\Filters\FiltersAbstract;

class AgentHierarchyPaymentFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'from_amount' => AmountFrom::class,
        'to_amount' => AmountTo::class,
        'pre_transaction_id' => PreTransactionIdFilter::class,
        'status' => StatusFilter::class,
        'parent_agent' => ParentAgentFilter::class,
        'sub_agent' => SubAgentFilter::class,
        'service' => ServiceFilter::class,
        'parent_agent_number' => ParentAgentNumberFilter::class,
        'sub_agent_number' => SubAgentNumberFilter::class,
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
