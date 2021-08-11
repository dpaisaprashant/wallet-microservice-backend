<?php


namespace App\Wallet\Microservice\Services;



use App\Models\UserBankAccount;
use App\Wallet\Microservice\PreTransactionMicroservice;
use App\Wallet\Microservice\RequestInfoMicroservice;
use Illuminate\Http\Request;

class NchlBankTransferService
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function bankListRequest()
    {
        $microservice = new RequestInfoMicroservice($this->request);

        $microservice->setServiceType("BANK_TRANSFER")
            ->setDescription("Get bank nchl bank list")
            ->setVendor("NCHL BANK TRANSFER")
            ->setMicroservice("NCHL")
            ->setUrl("/nchl-bank-list");

        return $microservice->processRequest();
    }

    public function branchListRequest($bankId)
    {
        $microservice = new RequestInfoMicroservice($this->request);

        $microservice->setServiceType("BANK_TRANSFER")
            ->setDescription("Get NCHL bank branch list of id {$bankId}")
            ->setVendor("NCHL BANK TRANSFER")
            ->setMicroservice("NCHL")
            ->setUrl("/nchl-branch-list/{$bankId}");

        return $microservice->processRequest();
    }

    public function processBankTransferRequest()
    {
        if ($this->request->account_id) {
            $bankAccount = UserBankAccount::whereUserId(auth()->user()->id)->whereId($this->request->account_id)->firstOrFail();
            $this->request->merge([
                "bank_id" => $bankAccount->bank_id,
                "account_name" => $bankAccount->account_name,
                "account_number" => $bankAccount->account_number,
                "branch_id" => $bankAccount->branch_id,
                "bank_name" => $bankAccount->bank_name,
                "branch_name" => $bankAccount->branch_name,
            ]);
        }

        $microservice = new PreTransactionMicroservice($this->request);
        $microservice->setServiceType("BANK_TRANSFER")
            ->setDescription("bank transfer")
            ->setVendor("NCHL BANK TRANSFER")
            ->setMicroservice("NCHL")
            ->setUrl("/nchl/process-bank-transfer")
            ->setTransactionType("debit")
            ->setRequestParam([
                "amount" => $this->request->amount,
                "bank_id" => $this->request->bank_id,
                "account_name" => $this->request->account_name,
                "account_number" => $this->request->account_number,
                "branch_id" => $this->request->branch_id,
                "bank_name" => $this->request->bank_name,
                "branch_name" => $this->request->branch_name,
                "account_id" => $this->request->account_id ?? null
            ]);

        return $microservice->processRequest();
    }

    public function validateBankAccountRequest()
    {
        $microservice = new RequestInfoMicroservice($this->request);

        $microservice->setServiceType("BANK_TRANSFER")
            ->setDescription("Validate bank Account")
            ->setVendor("NCHL BANK TRANSFER")
            ->setMicroservice("NCHL")
            ->setUrl("/validate-bank-account")
            ->setApiParams();

        return $microservice->processRequest();
    }
}
