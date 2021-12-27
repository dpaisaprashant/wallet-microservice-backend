<?php

namespace App\Wallet\NEA\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NeaSettlement;
use App\Traits\CollectionPaginate;
use App\Models\NeaTransaction;
use App\Wallet\Helpers\TransactionIdGenerator;
use App\Wallet\WalletAPI\NeaSettlementAPIMicroservice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\isEmpty;

class NEAController extends Controller
{
    public function ViewNEASettlement(){
        $nea_transactions = NeaTransaction::filter(request())->where('status','=','true')->latest()->get();
        $nea_settlements = NeaSettlement::get();
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
        return view('NEA::neaSettlement')->with(compact('nea_informations','transaction_count_total','transaction_sum_total','nea_settlements'));
    }

    public function SettleNea(Request $request){
        $nea_settlement = $request->all();
        $nea_settlement['transaction_sum'] = $nea_settlement['transaction_sum'] * 100;

        try {
            $bank_details = config('nea-bank-details.'.$nea_settlement['nea_branch_code']);
        }catch (\Exception $exception){
            Log::info($exception);
            return back()->with('error','Cannot Settle For This Branch At The Moment, Sorry for the Inconvenience');
        }


        $nea_bank_details = [
            'bank_code' => $bank_details['bank_id'],
            'bank_name' => $bank_details['bank_name'],
            'bank_account_name' => $bank_details['account_name'],
            'bank_account_number' => $bank_details['account_number'],
            'status' => 'STARTED',
            'non_real_time_bank_transfer_id' => 0,
            'pre_transaction_id' => TransactionIdGenerator::generate(19)
        ];

        $nea_settlement = array_merge($nea_settlement,$nea_bank_details);


        //changing date format for date_from and date_to starts
        // from date = start of the month to date = end of the month
        $formatted_request_date = date("Y-m-d",strtotime(str_replace(',', ' ', $nea_settlement['date_from'])));

//        FOR PARTICULAR MONTH

//        $carbon_request_date = Carbon::createFromDate($formatted_request_date);
//
//        $start_of_the_month = $carbon_request_date->startOfMonth()->format('Y-m-d');
//        $end_of_the_month = $carbon_request_date->endOfMonth()->format('Y-m-d');

//        FOR PARTICULAR MONTH END

        $nea_settlement['date_from'] = $formatted_request_date;
        $nea_settlement['date_to'] = $formatted_request_date;
        //changing date format for date_from and date_to ends

        try {
            $createSettlement = NeaSettlement::create($nea_settlement);
            $nea_settlement['branch_id'] = $bank_details['branch_id'];

            // calling the api
            $neaSettlementAPI = new NeaSettlementAPIMicroservice();
            $settleNeaResponse = $neaSettlementAPI->processBankTransferRequest($nea_settlement); // saving the response from the called api

            // check if response is json or not
            if (!is_array($settleNeaResponse)){
                $nea_settlement['json_response'] = $settleNeaResponse;
                $settleNeaResponse = json_decode($settleNeaResponse,true);
            }else{
                $nea_settlement['json_response'] = json_encode($settleNeaResponse);
            }

            //save json_response in nea_settlements table
            $setJsonResponse = NeaSettlement::where('id','=',$createSettlement->id)->update([
                'json_response' => $nea_settlement['json_response']
            ]);

            // check if the response yielded success OR failure and update status of nea_settlements accordingly
            if ($settleNeaResponse['transaction']['pre_transaction_status'] == "true"){
                $updateStatusNeaSettlement = NeaSettlement::where('id','=',$createSettlement->id)->update([
                    'status'=> 'SUCCESS'
                ]);
                return back()->with('success','nea settlement successful.');
            }else{
                $updateStatusNeaSettlement = NeaSettlement::where('id','=',$createSettlement->id)->update([
                    'status'=> 'ERROR'
                ]);
                return back()->with('error','nea settlement failed.');
            }
            return back()->with('error','nea settlement failed.');

        }catch (\Exception $exception){
            Log::info($exception);
            return back()->with('error','nea settlement failed.');
        }
    }

}
