<?php


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
            foreach ($agentType->agents as $agent) {
                $maxCodeForeAgentForAgentType = $agent->map(function ($value) {
                    $value['agent_code_num'] = 0;
                    if ($value['agent_code']) {
                        $value['agent_code_num'] = substr($value['agent_code'], -5);
                    }
                    return $value;
                });
                $maxCodeForeAgentForAgentType = $maxCodeForeAgentForAgentType->agents->max("agent_code_num") ?? 0;
                $maxCodeForeAgentForAgentType = (int) $maxCodeForeAgentForAgentType;
                $maxCodeForeAgentForAgentType++;

                $codeNum = sprintf('%05d',$maxCodeForeAgentForAgentType);
                $code = $walletCode . $agentType->type_code . $codeNum;

                $agentType->agents->update(["agent_code" => $code]);
            }

        }

    }
}
