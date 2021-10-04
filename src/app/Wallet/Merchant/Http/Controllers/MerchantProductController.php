<?php


namespace App\Wallet\Merchant\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\EventCashback;
use App\Models\Merchant\MerchantProduct;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Merchant\Merchant;
use Illuminate\Support\Facades\Validator;

class MerchantProductController extends Controller
{
    public function addProduct(Request $request)
    {
        $merchants = Merchant::with('user')->get();

        return view('Merchant::merchantProduct.add-merchant-product')->with(compact('merchants'));
    }

    public function createProduct(Request $request)
    {
        $merchantProduct = new MerchantProduct();

//        $validator = Validator::make($request->all(), $merchantProduct->rules());
//        if ($validator->fails()) {
//            return redirect()->route('merchant.product.list')->with('error', 'Merchant already exists on the table. Failed to add merchant product.');
//        }

        MerchantProduct::create([
            'merchant_id' => $request->merchant_id,
            'name' => $request->name,
            'price' => $request->price,
            'type' => $request->type,
            'service_charge' => $request->service_charge,
            'description' => $request->description,
        ]);

        return redirect()->route('merchant.product.list')->with('success', 'Merchant Product Added Successfully');
    }

    public function listProduct(Request $request)
    {
        $merchantProducts = MerchantProduct::with('merchant')->paginate(15);

        return view('Merchant::merchantProduct.merchant-product')->with(compact('merchantProducts'));
    }

    public function deleteProduct($id)
    {
        $merchantProduct = MerchantProduct::findOrFail($id);

        $merchantProduct->delete();

        return redirect()->route('merchant.product.list')->with('success', 'Merchant Product Deleted Successfully');
    }

    public function editProduct($id)
    {

        $merchantProduct = MerchantProduct::findOrFail($id);
        $merchants = Merchant::with('user')->get();
        return view('Merchant::merchantProduct.edit-merchant-product', compact('merchantProduct', 'merchants'));
    }

    public function updateProduct(Request $request, $id)
    {

        $merchantProduct = MerchantProduct::findOrFail($id);
        MerchantProduct::where('id', $id)->update([
            'merchant_id' => $request->get('merchant_id'),
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'type' => $request->get('type'),
            'service_charge' => $request->get('service_charge'),
            'description' => $request->get('description'),
        ]);

        return redirect()->route('merchant.product.list')->with('success', 'Merchant Product Updated Successfully');
    }

}
