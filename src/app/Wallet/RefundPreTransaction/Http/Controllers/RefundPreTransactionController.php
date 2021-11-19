<?php


namespace App\Wallet\RefundPreTransaction\Http\Controllers;

use App\Models\Microservice\PreTransaction;
//use App\Models\PreTransaction;
use App\Models\User;
use App\Wallet\Helpers\TransactionIdGenerator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\WalletIP;
use App\Models\WhitelistIP;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;

class RefundPreTransactionController extends Controller
{


    public function view()
    {
//        $preTransactions = \App\Models\Microservice\PreTransaction::where('service_type','REFUND')->orderBy('created_at', 'DESC')->paginate(20);

        $vendors = \App\Models\Microservice\PreTransaction::groupBy('vendor')->pluck('vendor');
        $service_types = PreTransaction::groupBy('service_type')->pluck('service_type');
        $microservice_types = PreTransaction::groupBy('microservice_type')->pluck('microservice_type');
        $transaction_types = PreTransaction::groupBy('transaction_type')->pluck('transaction_type');
        $preTransactions = \App\Models\Microservice\PreTransaction::where('service_type', 'REFUND')->filter(request())->latest()->paginate(10);

        return view('RefundPreTransaction::view-refund-pretransaction')->with(
            compact(
                'preTransactions',
                'vendors',
                'service_types',
                'microservice_types',
                'transaction_types',
            )
        );
//        return view('RefundPreTransaction::view-refund-pretransaction', compact('preTransactions'));
    }

    public function create(Request $request)
    {
        return view('RefundPreTransaction::create-refund-pretransaction');
    }

    public function store(Request $request)
    {
        $userId = User::where('mobile_no', $request->get('user_mobile_no'))->pluck('id')->first();

        if(!$userId) {
            return redirect()->route('refund.pretransaction.create')->with('error', 'The Mobile Number doesnt exist in the database.');
        }

            $preTransaction = \App\Models\Microservice\PreTransaction::create([
                'pre_transaction_id' => TransactionIdGenerator::generate(19),
                'user_id' => $userId,
                'amount' => $request->get('amount'),
                'description' => $request->get('description'),
                'vendor' => 'WALLET',
                'service_type' => 'REFUND',
                'microservice_type' => 'WALLET',
                'transaction_type' => 'debit',
                'Url' => '/refund',
                'Status' => 'FAILED',
                'created_at' => \Carbon\Carbon::createFromFormat('m/d/Y h:i A', $request->get('created_at')),
            ]);


        return redirect()->route('refund.pretransaction.view')->with('success', 'PreTransaction Row Created.');
    }

    public function edit($id)
    {

        $preTransaction = \App\Models\Microservice\PreTransaction::findOrFail($id);

        return view('RefundPreTransaction::edit-refund-pretransaction', compact('preTransaction'));
    }

    public function update(Request $request, $id)
    {
        $preTransaction = \App\Models\Microservice\PreTransaction::findOrFail($id);

        $userId = User::where('mobile_no', $request->get('user_mobile_no'))->pluck('id')->first();

        \App\Models\Microservice\PreTransaction::where('id', $id)->update([
            'user_id' => $userId,
            'description' => $request->get('description'),
            'amount' => $request->get('amount'),
            'created_at' => \Carbon\Carbon::createFromFormat('m/d/Y h:i A', $request->get('created_at')),
        ]);

        return redirect()->route('refund.pretransaction.view')->with('success', 'Updated successfully');
    }

}
