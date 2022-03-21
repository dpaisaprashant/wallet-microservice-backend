<?php


use App\Models\Agent;
use App\Models\AgentType;
use App\Models\Microservice\PreTransaction;
use Illuminate\Database\Seeder;

class AgentCodeSeeder extends Seeder
{
    public function run()
    {
        $walletCode = "17028";
        $agentTypes = AgentType::with('agents')->get();
        foreach ($agentTypes as $agentType) {

            $maxCodeForeAgentForAgentType = $agentType->agents->map(function ($value) {
                $value['agent_code_num'] = 0;
                if ($value['agent_code']) {
                    $value['agent_code_num'] = substr($value['agent_code'], -5);
                }
                return $value;
            });

            $maxCodeForeAgentForAgentType = $maxCodeForeAgentForAgentType->max("agent_code_num") ?? 0;
            $maxCodeForeAgentForAgentType = (int) $maxCodeForeAgentForAgentType;
            $maxCodeForeAgentForAgentType++;

            foreach ($agentType->agents as $agent) {

                if (empty($agent->agent_code)) {
                    $codeNum = sprintf('%05d',$maxCodeForeAgentForAgentType);
                    $code = $walletCode . $agentType->type_code . $codeNum;

                    Agent::where("id", $agent->id)
                        ->update(["agent_code" => $code]);

                    $maxCodeForeAgentForAgentType++;
                }
            }

        }

    }
}
