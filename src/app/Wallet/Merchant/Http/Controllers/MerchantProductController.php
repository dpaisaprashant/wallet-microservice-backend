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

        $validator = Validator::make($request->all(), $merchantProduct->rules());
        if ($validator->fails()) {
            return redirect()->route('merchant.product.list')->with('error', 'Merchant already exists on the table. Failed to add merchant product.');
        }

        MerchantProduct::create([
            "type" => $request->type,
            "json_data" => $request->json_data,
            "merchant_id" => $request->merchant_id
        ]);

        return redirect()->route('merchant.product.list')->with('success', 'Merchant Product Added Successfully');
    }

    public function listProduct(Request $request)
    {
        $merchantProducts = MerchantProduct::with('merchantProductUsers')->paginate(15);

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
            "type" => $request->get('type'),
            "json_data" => $request->get('json_data'),
            "merchant_id" => $request->get('merchant_id')
        ]);

        return redirect()->route('merchant.product.list')->with('success', 'Merchant Product Updated Successfully');
    }

}
