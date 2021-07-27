<?php


namespace App\Wallet\Agent\Repositories;


use App\Models\AgentType;
use App\Models\Setting;
use Illuminate\Http\Request;


class AgentTypeRepository
{
    private $request;

    CONST DEFAULT_AGENT = 'default_agent';
    CONST DEFAULT_SUB_AGENT = 'default_sub_agent';

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    private function createHierarchyCashback(AgentType $agentType)
    {
        $allParentAgentTypesList = $agentType->getAllParentAgentTypes();
        //create row for cashback having no parent
        $agentType->agentTypeHierarchyCashbacks()->create();
        //create cashback for each parent
        foreach ($allParentAgentTypesList as $parentAgentType) {
            //create cashback for its parent types
            $agentType->agentTypeHierarchyCashbacks()->create([
                'parent_agent_type_id' => $parentAgentType->id,
            ]);
        }

        //check if has agent type has parent agent type
        //if empty set parent_type_id as null
        //else create commission for that agent type with relation to its agent_type_parent
        //also check if agent_type_parent has a parent if yes than creat cashback for that agent_type_parent with the tst agent type
    }



    public function createAgentType()
    {
        $agentType = AgentType::create($this->request->all());

        //create linit for agent type
        $agentName = str_replace(" ", "_", $agentType->name);
        $agentName = strtolower($agentName);

        if ($agentType->agent_type_id) {

            $limits = $this->defaultSubAgentLimits();
            $newAgentLimit = [];
            foreach ($limits as $limit) {
                $limit['option'] = str_replace(self::DEFAULT_SUB_AGENT, $agentName, $limit['option']);
                Setting::updateOrCreate($limit);
                //array_push($newAgentLimit, $limit);
            }

        }else {
            $limits = $this->defaultAgentLimits();
            $newAgentLimit = [];
            foreach ($limits as $limit) {
                $limit['option'] = str_replace(self::DEFAULT_AGENT, $agentName, $limit['option']);
                Setting::updateOrCreate($limit);
                //array_push($newAgentLimit, $limit);
            }
        }


        //create hierarchy cashback for agent type
        $this->createHierarchyCashback($agentType);

        return $agentType;
    }

    protected function defaultAgentCashbacks()
    {
        return Setting::select('option', 'value')->where('option', 'like', self::DEFAULT_AGENT . '_cb_%')->get()->toArray();
    }

    protected function defaultAgentLimits()
    {
        return Setting::select('option', 'value')->where('option', 'like', self::DEFAULT_AGENT . '_%_limit')->get()->toArray();
    }

    protected function defaultSubAgentCashbacks()
    {
        return Setting::select('option', 'value')->where('option', 'like', self::DEFAULT_SUB_AGENT . '_cb_%')->get()->toArray();
    }

    protected function defaultSubAgentLimits()
    {
        return Setting::select('option', 'value')->where('option', 'like', self::DEFAULT_SUB_AGENT . '_%_limit')->get()->toArray();
    }
}
