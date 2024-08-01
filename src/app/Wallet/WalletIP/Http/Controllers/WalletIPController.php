<?php


namespace App\Wallet\WalletIP\Http\Controllers;


use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\WalletIP;
use App\Models\WhitelistIP;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;

class WalletIPController extends Controller
{
   

    public function view()
    {
        $blockedIPs =  WalletIP::orderBy('created_at','DESC')->paginate(20);       
        
        return view('WalletIP::viewBlockedIP',compact('blockedIPs'));
    }

    public function create(Request $request)
    {
        $blockedIP = WalletIP::all();       
        
        return view('WalletIP::createBlockedIP',compact('blockedIP'));
        
    }
    
    public function store(Request $request)
    {
        $blockedIPAlreadyExists = WalletIP::where('ip',$request->get('ip'))->count();
        
        if($blockedIPAlreadyExists > 0){
            return redirect()->route('blockedip.view')->with('error','IP already exists in blocked list');
        }

        $blockedIP = WalletIP::create([            
            'ip' => $request->get('ip'),
            'description' => $request->get('description'),
            'blocked_at' => $request->get('blocked_at'),
            'block_duration' => $request->get('block_duration'),
            'status' => $request->get('status')
        ]);

        return redirect()->route('blockedip.view')->with('success','IP added to block list');
    }

    public function delete($id)
    {
        $blockedIP = WalletIP::findOrFail($id);

        $blockedIP->delete();

        return redirect()->route('blockedip.view')->with('success','IP deleted successfully');
    }

    public function edit($id){
        
        $blockedIP = WalletIP::findOrFail($id);
   
        return view('WalletIP::editBlockedIP', compact('blockedIP'));
    }

    public function update(Request $request, $id){
        
        $blockedIP = WalletIP::findOrFail($id);

        $blockedIP = WalletIP::where('id', $id)->update([            
            'ip' => $request->get('ip'),
            'description' => $request->get('description'),
            'blocked_at' => $request->get('blocked_at'),
            'block_duration' => $request->get('block_duration'),
            'status' => $request->get('status')
        ]);

        return redirect()->route('blockedip.view')->with('success','Updated successfully');
    }    

    //WhiteList IP
    public function view_whitelist()
    {
        $whitelistedIPs =  WhitelistIP::orderBy('created_at','DESC')->paginate(20);       
        
        return view('WalletIP::whitelistedIP/viewWhitelistedIP',compact('whitelistedIPs'));
    }

    public function create_whitelist(Request $request)
    {
        $whitelistedIPs = WhitelistIP::all();       
        
        return view('WalletIP::whitelistedIP/createWhitelistedIP',compact('whitelistedIPs'));
        
    }
    
    public function store_whitelist(Request $request)
    {
        $whitelistedIPAlreadyExists = WhitelistIP::where('ip',$request->get('ip'))->count();
        
        if($whitelistedIPAlreadyExists > 0){
            return redirect()->route('whitelistedIP.view')->with('error','IP already exists in list');
        }

        $whitelistedIP = WhitelistIP::create([            
            'ip' => $request->get('ip'),
            'title' => $request->get('title'),
            'status' => $request->get('status'),            
        ]);

        return redirect()->route('whitelistedIP.view')->with('success','IP Whitelisted');
    }

    public function delete_whitelist($id)
    {
        $whitelistedIP = WhitelistIP::findOrFail($id);

        $whitelistedIP->delete();

        return redirect()->route('whitelistedIP.view')->with('success','IP deleted successfully');
    }

    public function edit_whitelist($id){
        
        $whitelistedIP = WhitelistIP::findOrFail($id);
   
        return view('WalletIP::whitelistedIP/editWhitelistedIP', compact('whitelistedIP'));
    }

    public function update_whitelist(Request $request, $id){
        
        $whitelistedIP = WhitelistIP::findOrFail($id);

        $whitelistedIP = WhitelistIP::where('id', $id)->update([            
            'ip' => $request->get('ip'),
            'title' => $request->get('title'),
            'status' => $request->get('status'),    
        ]);

        return redirect()->route('whitelistedIP.view')->with('success','Updated successfully');
    }    
    
}
