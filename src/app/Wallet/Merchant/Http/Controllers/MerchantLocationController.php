<?php


namespace App\Wallet\Merchant\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\EventCashback;
use App\Models\Location;
use App\Models\Merchant\MerchantProduct;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Merchant\Merchant;
use Illuminate\Support\Facades\Validator;

class MerchantLocationController extends Controller
{
    public function addLocation(Request $request)
    {
        $merchants = Merchant::with('user')->get();

        return view('Merchant::merchantLocation.add-merchant-location')->with(compact('merchants'));
    }

    public function createLocation(Request $request)
    {
        $location = new Location();

        $validator = Validator::make($request->all(), $location->rules());
        if ($validator->fails()) {
            return redirect()->route('merchant.location.list')->with('error', 'Location already exists on the table. Failed to add new location.');
        }

        Location::create([
            "name" => $request->name,
        ]);

        return redirect()->route('merchant.location.list')->with('success', 'Location Added Successfully');
    }

    public function listLocation(Request $request)
    {
        $locations = Location::with('merchantAddressLocation')->paginate(15);

        return view('Merchant::merchantLocation.merchant-location')->with(compact('locations'));
    }

    public function deleteLocation($id)
    {
        $location = Location::findOrFail($id);

        $location->delete();

        return redirect()->route('merchant.location.list')->with('success', 'Merchant Address Deleted Successfully');
    }

    public function editLocation($id)
    {
        $location = Location::findOrFail($id);
        $merchants = Merchant::with('user')->get();
        return view('Merchant::merchantLocation.edit-merchant-location', compact('location', 'merchants'));
    }

    public function updateLocation(Request $request, $id)
    {
        $location = Location::findOrFail($id);
        Location::where('id', $id)->update([
            "name" => $request->get('name'),
        ]);

        return redirect()->route('merchant.location.list')->with('success', 'Merchant Location Updated Successfully');
    }

}
