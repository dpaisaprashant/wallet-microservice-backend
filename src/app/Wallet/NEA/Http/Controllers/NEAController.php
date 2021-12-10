<?php

namespace App\Wallet\NEA\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NeaSettlement;
use App\Traits\CollectionPaginate;
use App\Models\NeaTransaction;
use Illuminate\Http\Request;

class NEAController extends Controller
{
    public function ViewNEASettlement(){
        $nea_transactions = NeaTransaction::filter(request())->latest()->get();


//        $nea_transactions = NeaTransaction::get();
        $nea_informations = [];
        $branch_names = config('nea-branches');
        $transaction_count_total = 0;
        $transaction_sum_total = 0;
        foreach ($nea_transactions as $nea_transaction){
            $json_request = json_decode($nea_transaction->request_json);
            if (! array_key_exists($json_request->officeCode,$nea_informations)){
                $nea_informations[$json_request->officeCode] = ['branch_code'=>$json_request->officeCode,'branch_name'=>$branch_names[$json_request->officeCode],'transaction_count'=>1,'transaction_sum'=>$json_request->amount /100];
            }
            else{
                $nea_informations[$json_request->officeCode]['transaction_count'] = $nea_informations[$json_request->officeCode]['transaction_count'] + 1;
                $nea_informations[$json_request->officeCode]['transaction_sum'] = $nea_informations[$json_request->officeCode]['transaction_sum'] +  ($json_request->amount / 100);
            }
            $transaction_count_total = $transaction_count_total + 1;
            $transaction_sum_total = $transaction_sum_total + ($json_request->amount/100);
        }
        return view('NEA::neaSettlement')->with(compact('nea_informations','transaction_count_total','transaction_sum_total'));
    }

    public function SettleNea(Request $request){
        $nea_settlement = $request->all();
        $nea_settlement['bank_code'] = 666;
        $nea_settlement['status'] = 'STARTED';
        $nea_settlement['non_real_time_bank_transfer_id'] = 15;
        //changing date format for date_from and date_to starts
        $nea_settlement['date_from'] = date("Y-m-d", strtotime($nea_settlement['date_from']));
        $nea_settlement['date_to'] = date("Y-m-d", strtotime($nea_settlement['date_to']));
        //changing date format for date_from and date_to ends
        try {
            $createSettlement = NeaSettlement::create($nea_settlement);
            return back()->with('success','nea settlement started');
        }catch (\Exception $exception){
            return back()->with('error','nea settlement failed.');
        }
//        dd($nea_settlement['nea_branch_code']);
    }

}
