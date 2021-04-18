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

    public function createAgentType()
    {
        $agentType = AgentType::create($this->request->all());

        $agentName = str_replace(" ", "_", $agentType->name);
        $agentName = strtolower($agentName);

        if ($agentType->agent_type_id) {

            /*$cashbacks = $this->defaultSubAgentCashbacks();
            $newAgentCashback = [];
            foreach ($cashbacks as $cashback) {
                $cashback['option'] = str_replace(self::DEFAULT_SUB_AGENT, $agentName, $cashback['option']);
                Setting::updateOrCreate($cashback);
            }*/


            $limits = $this->defaultSubAgentLimits();
            $newAgentLimit = [];
            foreach ($limits as $limit) {
                $limit['option'] = str_replace(self::DEFAULT_SUB_AGENT, $agentName, $limit['option']);
                Setting::updateOrCreate($limit);
                //array_push($newAgentLimit, $limit);
            }

        }else {
            /*$cashbacks = $this->defaultAgentCashbacks();
            $newAgentCashback = [];
            foreach ($cashbacks as $cashback) {
                $cashback['option'] = str_replace(self::DEFAULT_AGENT, $agentName, $cashback['option']);
                Setting::updateOrCreate($cashback);
                //array_push($newAgentCashback, $cashback);
            }*/


            $limits = $this->defaultAgentLimits();
            $newAgentLimit = [];
            foreach ($limits as $limit) {
                $limit['option'] = str_replace(self::DEFAULT_AGENT, $agentName, $limit['option']);
                Setting::updateOrCreate($limit);
                //array_push($newAgentLimit, $limit);
            }
        }

        //Setting::insert($newAgentCashback);
        //Setting::insert($newAgentLimit);

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
