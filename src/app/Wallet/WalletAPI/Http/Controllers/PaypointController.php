<?php
namespace App\Http\Controllers\API;

use App\Events\CreditTransactionCompleteEvent;
use App\Events\DebitTransactionCompleteEvent;
use App\Models\TransactionEvent;
use App\Models\Wallet;
use App\Wallet\Architecture\Builders\WalletTransactionTypeValidationBuilder;
use App\Wallet\Architecture\Traits\DeductBalanceBeforeRequest;
use App\Wallet\Architecture\Validations\BalanceValidation\UserBonusBalanceValidation;
use App\Wallet\Architecture\Validations\WalletTransactionTypeValidation;
use App\Wallet\Limits\Traits\CheckLimit;
use App\Wallet\Microservice\PreTransactionMicroservice;
use App\Wallet\Microservice\RequestInfoMicroservice;
use App\Wallet\Microservice\Response\DebitResponse;
use App\Wallet\Microservice\Services\PaypointPaymentService;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\MobileRechargeRequest;
use App\Http\Requests\PaypointTransactionRequest;
use App\Http\Requests\PaypointCheckPaymentRequest;
use App\Http\Requests\PaypointExecutePaymentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Arr;

class PaypointPaymentController extends Controller
{
use CheckLimit, DebitResponse, DeductBalanceBeforeRequest;

protected $microservice;

public function __construct(Request $request)
{
$this->middleware(["auth:api", "isLocked"]);
$this->microservice = new PaypointPaymentService($request);
}

/**
* @OA\Post (
*      path="/pp_one_step",
*      summary="Paypoint One Step Payment",
*      @OA\RequestBody(
*          description="Request Body",
*      ),
*      @OA\Response(
*          response="200",
*          description="Onestep paypoint payment successful",
*          @OA\JsonContent(
*              type="object",
*              ref="#/components/schemas/PaypointSuccessResponseAPISchema",
*          ),
*      ),
*      @OA\Response(
*          response="400",
*          description="Error: Bad request",
*          @OA\JsonContent(
*              type="object",
*              ref= "#/components/schemas/PaypointErrorResponseAPISchema"
*          )
*      ),
* )
*/
public function pp_one_step(PaypointTransactionRequest $request)
{
$validator = new WalletTransactionTypeValidationBuilder($request->user(), $request->amount);
$validate = $validator->paypointValidation($request)
->validate();
$walletTransactionType = $validate
->getWalletTransactionType();

$this->deductUserBalance($request->user(), $validate);

$response = $this->microservice->oneStepRequest();
$response = json_decode($response, true);

return $this->handleDebitResponse($request, $response, $walletTransactionType);
}

public function pp_two_step_check(PaypointCheckPaymentRequest $request)
{
$response = $this->microservice->twoStepCheckRequest();
if ($response instanceof JsonResponse) {
return $response;
}
return json_decode($response, true);
}

public function pp_two_step_execute(PaypointExecutePaymentRequest $request)
{
$validator = new WalletTransactionTypeValidationBuilder($request->user(), $request->amount);
$validate = $validator->paypointValidation($request)->validate();
$walletTransactionType = $validate
->getWalletTransactionType();


$this->deductUserBalance($request->user(), $validate);

$response = $this->microservice->twoStepExecuteRequest();
$response = json_decode($response, true);

return $this->handleDebitResponse($request, $response, $walletTransactionType);
}
}
