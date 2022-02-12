<?php


namespace App\Wallet\Scheme\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Scheme;
use Illuminate\Http\Request;
use App\Wallet\Helpers\TransactionIdGenerator;

class SchemeController extends Controller
{

    public function index(){
        $schemes = Scheme::orderBy('created_at','DESC')->get();
        return view('Scheme::scheme.viewScheme',compact('schemes'));
    }

    public function create(){
        return view('Scheme::scheme.createScheme');
    }

    public function store(Request $request){
        $schemeName = $request->get('scheme_name');
        $schemeCode = $schemeName.'-'.TransactionIdGenerator::generateAlphaNumeric(8);
        $scheme = Scheme::create([
            'name' => $schemeName,
            'scheme_code' => $schemeCode,
            'allow_cashback' => $request->get('allow_cashback'),
            'allow_commission' => $request->get('allow_commission'),
            'validate_kyc' => $request->get('validate_kyc'),
            'status' => $request->get('status')
        ]);
        if($scheme){
            return redirect()->route('scheme.index')->with('success','Scheme created successfully');
        }else{
            return redirect()->route('scheme.index')->with('error','Something went wrong');
        }

    }

    public function delete($id){
        $schemeData = Scheme::findOrFail($id);
        $scheme = $schemeData->delete();
        if($scheme){
            return redirect()->route('scheme.index')->with('success','Scheme deleted successfully');
        }else{
            return redirect()->route('scheme.index')->with('error','Something went wrong');
        }
    }

    public function edit($id){
        $scheme = Scheme::where('id',$id)->first();
        return view('Scheme::scheme.editScheme',compact('scheme'));
    }

    public function update($id,Request $request){
        $scheme = Scheme::where('id',$id)->update([
            'name' => $request->get('scheme_name'),
            'allow_cashback' => $request->get('allow_cashback'),
            'allow_commission' => $request->get('allow_commission'),
            'validate_kyc' => $request->get('validate_kyc'),
            'status' => $request->get('status')
        ]);

        if($scheme){
            return redirect()->route('scheme.index')->with('success','Scheme updated successfully');
        }else{
            return redirect()->route('scheme.index')->with('error','Something went wrong');
        }

    }


}
