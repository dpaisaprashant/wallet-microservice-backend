<?php


namespace App\Wallet\WalletRegistration\Http\Controllers;


use App\Models\Merchant\Merchant;
use App\Models\MobileOTP;
use App\Models\User;
use App\Wallet\Traits\ApiResponder;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Traits\CollectionPaginate;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;
use App\Wallet\WalletRegistration\Microservice\MerchantRegistrationMicroservice;
use App\Wallet\WalletRegistration\Exceptions\MicroserviceException;

class MerchantRegistrationController extends Controller
{

    use ApiResponder;

    public function view()
    {
        $merchants = Merchant::all();

        return view('WalletRegistration::create-merchant', compact('merchants'));
    }

    public function create(Request $request, MerchantRegistrationMicroservice $microservice)
    {
        $response = $this->generateOTP($request);

        MobileOTP::where('mobile_no', $request->mobile_no)->update([
            'phone_verified_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $microservice->createMerchant();

        User::where('mobile_no', $request->mobile_no)->update([
            'should_change_password' => 1,
            'should_change_password_message'=>'Password needs to be changed.'
        ]);

        BackendUserMerchants::create([
           'user_id' => auth()->user()->id,

        ]);

        return redirect()->route('create.merchant.view')->with('success', 'Merchant created successfully');
    }

    public function generateOTP(Request $request)
    {
        try {
            $client = new Client();
            $response = $client->request('POST', 'nginx_core_wallet/api/otp/mobile/generate', [
                "headers" => [
                    'App-Authorizer' => '647061697361',
                ],
                'multipart' => [
                    [
                        'name' => 'mobile_no',
                        'contents' => $request->mobile_no
                    ],
                ]
            ]);
            return $response->getBody()->getContents();
        } catch (ClientException $e) {
            Log::info("Client Exception");
            Log::info($e);
            throw new MicroserviceException(
                $e->getMessage()
            );
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            Log::info("Request Exception");
            Log::info($e);
            throw new MicroserviceException(
                $e->getMessage()
            );

        } catch (ConnectException $e) {
            //TODO: Notify Developers
            Log::info($e);
            dd("connection exception");
//            throw new MicroserviceException(
//                $e->getMessage()
//            );

        } catch (\Exception $e) {
            Log::info("Unknown Exception");
            Log::info($e);
            throw new MicroserviceException(
                $e->getMessage()
            );
        }
    }
}
