<?php


namespace App\Wallet\Microservice;


use App\Events\CreditTransactionCompleteEvent;
use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\Wallet;
use App\Wallet\Architecture\Builders\WalletTransactionTypeValidationBuilder;
use App\Wallet\Architecture\Traits\DeductBalanceBeforeRequest;
use App\Wallet\Helpers\TransactionIdGenerator;
use App\Wallet\Microservice\Exceptions\MicroserviceClientException;
use App\Wallet\Microservice\Response\CreditResponse;
use App\Wallet\Microservice\Response\DebitResponse;
use App\Wallet\Traits\CheckValidJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GatewayMicroservice extends MicroserviceJSONAbstract
{
    use CheckValidJson, CreditResponse, DebitResponse, DeductBalanceBeforeRequest;

    private $preTransactionId;
    private $userId;
    private $amount;
    private $account;
    private $description;
    private $vendor;
    private $serviceType;
    private $microservice;
    private $special1;
    private $special2;
    private $special3;
    private $special4;
    private $status;
    private $transactionType;
    private $jsonRequest = [];
    private $jsonResponse;
    private $requestParam = [];
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->preTransactionId = TransactionIdGenerator::generate(19);
    }

    public function setPreTransactionId($preTransactionId)
    {
        $this->preTransactionId = $preTransactionId;
        return $this;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setVendor($vendor)
    {
        $this->vendor = $vendor;
        return $this;
    }

    public function setServiceType($serviceType)
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    public function setMicroservice($microservice)
    {
        $this->microservice = $microservice;
        return $this;
    }

    public function setSpecial1($special1)
    {
        $this->special1 = $special1;
        return $this;
    }

    public function setSpecial2($special2)
    {
        $this->special2 = $special2;
        return $this;
    }

    public function setSpecial3($special3)
    {
        $this->special3 = $special3;
        return $this;
    }

    public function setSpecial4($special4)
    {
        $this->special4 = $special4;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setTransactionType($transactionType)
    {
        $this->transactionType = $transactionType;
        return $this;
    }

    public function setJsonRequest(array $jsonRequest): PreTransactionMicroservice
    {
        $this->jsonRequest = $jsonRequest;
        return $this;
    }

    public function setJsonResponse(array $jsonResponse): PreTransactionMicroservice
    {
        $this->jsonResponse = $jsonResponse;
        return $this;
    }

    public function setRequestParam(array $requestParam): PreTransactionMicroservice
    {
        $this->requestParam = $requestParam;
        return $this;
    }

    /**
     * @param mixed $account
     * @return GatewayMicroservice
     */
    public function setAccount($account)
    {
        $this->account = $account;
        return $this;
    }

    public function getPreTransactionId()
    {
        return $this->preTransactionId;
    }

    public function getPreTransaction()
    {
        return $this->preTransaction;
    }

    private function currentUser()
    {
        $user = User::whereId($this->userId)->first();
        $user->load(['wallet', 'kyc', 'referral']);
        return $user;
    }

    private function preRequest()
    {
        $wallet = Wallet::where('user_id', $this->currentUser()->id)->first();
        $this->jsonResponse = $this->request->all();

        $data = [
            'pre_transaction_id' => $this->preTransactionId,
            'user_id' => $this->userId,
            'amount' => $this->amount,
            'description' => $this->description,
            'vendor' => $this->vendor,
            'service_type' => $this->serviceType,
            'microservice_type' => $this->microservice,
            'transaction_type' => $this->transactionType,
            'url' => $this->url,
            'status' => $this->status,
            //'json_request' => $this->jsonRequest,
            'special1' => $this->special1,
            'special2' => $this->special2,
            'special3' => $this->special3,
            'special4' => $this->special4,
            "before_balance" => $wallet->balance,
            "before_bonus_balance" => $wallet->bonus_balance,
            "after_balance" => $wallet->balance,
            "after_bonus_balance" => $wallet->bonus_balance,
            'json_response' => $this->isValidJson($this->jsonResponse) ? $this->jsonResponse : json_encode($this->jsonResponse),
        ];

        unset($data["user"]);
        $this->preTransaction = PreTransaction::create($data);

    }

    public function postRequest()
    {
        if (! TransactionEvent::wherePreTransactionId($this->preTransaction->pre_transaction_id)->count()) {
            throw new MicroserviceClientException($this->preTransaction, 'Error while executing payment', "");
        }
        $this->preTransaction->update(['status' => PreTransaction::STATUS_SUCCESS]);
    }


    public function processRequest($endpoint = "")
    {

        $bounceCheck = PreTransaction::whereUserId($this->userId)->latest()->lockForUpdate()->first();
        if (!empty($bounceCheck) && $bounceCheck->created_at->diffInSeconds() < 6) {
            Log::info("Subsequent Request with diff - " .  $bounceCheck->created_at->diffInSeconds() . " id:" .$this->preTransactionId);
            throw new \Exception("Subsequent Request");
        }

        Log::info($this->vendor);
        Log::info("user Id", [$this->userId]);
        $this->preRequest();
        $transaction = array_merge($this->request->all(), [
            'pre_transaction_id' => $this->preTransaction->pre_transaction_id,
            'account' => $this->account,
            'vendor' => $this->vendor,
            'transaction_id' => $this->request->id,
        ]);

        Log::info("bfi transaction response", [$transaction]);

        $transaction['user_id'] = $this->userId;
        $transaction['transaction'] = array_merge($this->request->all(), [
            'pre_transaction_id' => $this->preTransaction->pre_transaction_id,
            'pre_transaction_status' => "true",
            'model' => $transaction['model'],
            'type' => $transaction['type'] ?? $this->transactionType ?? 'credit',
            'user_id' => $this->userId,
            'account' => $transaction['account'],
            'amount' => $this->amount,
            'vendor' => $this->vendor
        ]);


        Log::info("bfi transaction response", [$transaction]);


        return $transaction;
    }

    public function processCreditRequest()
    {
        DB::beginTransaction();

        $transaction = $this->processRequest();
        $user = $this->currentUser();

        $validator = new WalletTransactionTypeValidationBuilder($this->currentUser(), $transaction['amount']);
        $walletTransactionType = $validator->bfiGatewayLoadValidation($transaction['bfi_id'])
            ->validate()
            ->getWalletTransactionType();

        $this->handleCreditResponse([], $transaction, $walletTransactionType);

        $this->postRequest();
        $transaction['status'] = $this->preTransaction['status'] ?? PreTransaction::STATUS_FAILED;

        if ($transaction['status'] == PreTransaction::STATUS_SUCCESS) {
            $user->load(['wallet']);
            $this->preTransaction->update([
                "after_balance" => $user->wallet->balance,
                "after_bonus_balance" => $user->wallet->bonus_balance,
            ]);

            TransactionEvent::where('pre_transaction_id', $this->preTransaction->pre_transaction_id)->update([
                "balance" => $user->wallet->balance,
                "bonus_balance" => $user->wallet->bonus_balance,
            ]);
        }

        DB::commit();

        return $transaction;
    }


    public function processDebitRequest()
    {
        DB::beginTransaction();

        $transaction = $this->processRequest();
        $user = $this->currentUser();


        $validator = new WalletTransactionTypeValidationBuilder($user, $transaction['amount']);
        $validated = $validator->bfiGatewayPaymentValidation($transaction['bfi_id'])
            ->validate();
        $walletTransactionType = $validated->getWalletTransactionType();

        Log::info("handle response start for bfi", [$transaction]);
        $this->handleDebitResponse([], $transaction, $walletTransactionType);

        $this->postRequest();
        $transaction['status'] = $this->preTransaction['status'] ?? PreTransaction::STATUS_FAILED;
        if ($transaction['status'] == PreTransaction::STATUS_SUCCESS) {
            $this->deductUserBalance($user, $validated);
            $user->load(['wallet']);
            $this->preTransaction->update([
                "after_balance" => $user->wallet->balance,
                "after_bonus_balance" => $user->wallet->bonus_balance,
            ]);

            TransactionEvent::where('pre_transaction_id', $this->preTransaction->pre_transaction_id)->update([
                "balance" => $user->wallet->balance,
                "bonus_balance" => $user->wallet->bonus_balance,
            ]);
        }

        DB::commit();

        return $transaction;
    }


}
