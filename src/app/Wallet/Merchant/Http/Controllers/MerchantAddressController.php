<?php


namespace App\Wallet\Merchant\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\EventCashback;
use App\Models\Merchant\MerchantAddress;
use App\Models\Merchant\MerchantProduct;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Merchant\Merchant;
use Illuminate\Support\Facades\Validator;

class MerchantAddressController extends Controller
{
    public function addAddress(Request $request)
    {
        $merchants = Merchant::with('user')->get();

        return view('Merchant::merchantAddress.add-merchant-address')->with(compact('merchants'));
    }

    public function createAddress(Request $request)
    {
        $merchantAddress = new MerchantAddress();

        $validator = Validator::make($request->all(), $merchantAddress->rules());
        if ($validator->fails()) {
            return redirect()->route('merchant.address.list')->with('error', 'Address for the merchant already exists on the table. Failed to add new address for merchant.');
        }

        MerchantAddress::create([
            "location" => $request->location,
            "merchant_id" => $request->merchant_id
        ]);

        return redirect()->route('merchant.address.list')->with('success', 'Merchant Address Added Successfully');
    }

    public function listAddress(Request $request)
    {
        $merchantAddresses = MerchantAddress::with('merchantAddressUsers')->paginate(15);

        return view('Merchant::merchantAddress.merchant-address')->with(compact('merchantAddresses'));
    }

    public function deleteAddress($id)
    {
        $merchantAddress = MerchantAddress::findOrFail($id);

        $merchantAddress->delete();

        return redirect()->route('merchant.address.list')->with('success', 'Merchant Address Deleted Successfully');
    }

    public function editAddress($id)
    {

        $merchantAddress = MerchantAddress::findOrFail($id);
        $merchants = Merchant::with('user')->get();
        return view('Merchant::merchantAddress.edit-merchant-address', compact('merchantAddress', 'merchants'));
    }

    public function updateAddress(Request $request, $id)
    {

        $merchantAddress = MerchantAddress::findOrFail($id);
        MerchantAddress::where('id', $id)->update([
            "location" => $request->get('location'),
            "merchant_id" => $request->get('merchant_id')
        ]);

        return redirect()->route('merchant.address.list')->with('success', 'Merchant Address Updated Successfully');
    }

}
