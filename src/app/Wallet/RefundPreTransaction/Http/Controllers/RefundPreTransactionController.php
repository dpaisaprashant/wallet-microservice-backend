<?php


namespace App\Wallet\RefundPreTransaction\Http\Controllers;

use App\Models\PreTransaction;
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
        $preTransactions = \App\Models\Microservice\PreTransaction::where('service_type','REFUND')->orderBy('created_at', 'DESC')->paginate(20);
//        $preTransactions = \App\Models\Microservice\PreTransaction::where('service_type','REFUND')->first();
//dd($preTransactions);
        return view('RefundPreTransaction::view-refund-pretransaction', compact('preTransactions'));
    }

    public function create(Request $request)
    {
        $blockedIP = WalletIP::all();


        return view('RefundPreTransaction::create-refund-pretransaction', compact('blockedIP'));

    }

    public function store(Request $request)
    {
        //loadtestfund

        $userId = User::where('mobile_no', $request->get('user_mobile_no'))->pluck('id')->first();

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
            'created_at' => $request->get('created_at'),
        ]);

        return redirect()->route('preTransaction.view')->with('success', 'PreTransaction Row Created.');
    }

    public function delete($id)
    {
        $blockedIP = WalletIP::findOrFail($id);

        $blockedIP->delete();

        return redirect()->route('blockedip.view')->with('success', 'IP deleted successfully');
    }

    public function edit($id)
    {

        $blockedIP = WalletIP::findOrFail($id);

        return view('WalletIP::editBlockedIP', compact('blockedIP'));
    }

    public function update(Request $request, $id)
    {

        $blockedIP = WalletIP::findOrFail($id);

        $blockedIP = WalletIP::where('id', $id)->update([
            'ip' => $request->get('ip'),
            'description' => $request->get('description'),
            'blocked_at' => $request->get('blocked_at'),
            'block_duration' => $request->get('block_duration'),
            'status' => $request->get('status')
        ]);

        return redirect()->route('blockedip.view')->with('success', 'Updated successfully');
    }

    //WhiteList IP
    public function view_whitelist()
    {
        $whitelistedIPs = WhitelistIP::orderBy('created_at', 'DESC')->paginate(20);

        return view('WalletIP::whitelistedIP/viewWhitelistedIP', compact('whitelistedIPs'));
    }

    public function create_whitelist(Request $request)
    {
        $whitelistedIPs = WhitelistIP::all();

        return view('WalletIP::whitelistedIP/createWhitelistedIP', compact('whitelistedIPs'));

    }

    public function store_whitelist(Request $request)
    {
        $whitelistedIPAlreadyExists = WhitelistIP::where('ip', $request->get('ip'))->count();

        if ($whitelistedIPAlreadyExists > 0) {
            return redirect()->route('whitelistedIP.view')->with('error', 'IP already exists in list');
        }

        $whitelistedIP = WhitelistIP::create([
            'ip' => $request->get('ip'),
            'title' => $request->get('title'),
            'status' => $request->get('status'),
        ]);

        return redirect()->route('whitelistedIP.view')->with('success', 'IP Whitelisted');
    }

    public function delete_whitelist($id)
    {
        $whitelistedIP = WhitelistIP::findOrFail($id);

        $whitelistedIP->delete();

        return redirect()->route('whitelistedIP.view')->with('success', 'IP deleted successfully');
    }

    public function edit_whitelist($id)
    {

        $whitelistedIP = WhitelistIP::findOrFail($id);

        return view('WalletIP::whitelistedIP/editWhitelistedIP', compact('whitelistedIP'));
    }

    public function update_whitelist(Request $request, $id)
    {

        $whitelistedIP = WhitelistIP::findOrFail($id);

        $whitelistedIP = WhitelistIP::where('id', $id)->update([
            'ip' => $request->get('ip'),
            'title' => $request->get('title'),
            'status' => $request->get('status'),
        ]);

        return redirect()->route('whitelistedIP.view')->with('success', 'Updated successfully');
    }

}
