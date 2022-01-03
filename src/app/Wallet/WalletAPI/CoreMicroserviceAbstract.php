<?php


namespace App\Wallet\WalletAPI;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

abstract class CoreMicroserviceAbstract
{
    protected $apiParams = [];
    protected $baseUrl;
    protected $url;
    protected $httpMethod = 'POST';
    protected $documentFrontImage;
    protected $documentBackImage;
    protected $passportSizePhoto;
    protected $companyLogo;
    protected $companyDocument;
    protected $companyVatDocument;
    protected $companyTaxClearanceDocument;

    public function addParam($key, $value)
    {
        $this->apiParams[$key]  = $value;
        return $this;
    }

    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function setDocumentFrontImage($documentFrontImage)
    {
        $this->documentFrontImage = $documentFrontImage->store('userImages');
        return $this;
    }

    public function setDocumentBackImage($documentBackImage)
    {
        $this->documentBackImage = $documentBackImage->store('userImages');
        return $this;
    }

    public function setPassportSizePhoto($passportSizePhoto)
    {
        $this->passportSizePhoto = $passportSizePhoto->store('userImages');
        return $this;
    }

    public function setCompanyLogo($companyLogo)
    {
        $this->companyLogo = $companyLogo->store('merchantImages');
        return $this;
    }

    public function setCompanyDocument($companyDocument)
    {
        $this->companyDocument = $companyDocument->store('merchantImages');
        return $this;
    }

    public function setCompanyVatDocument($companyVatDocument)
    {
        $this->companyVatDocument = $companyVatDocument->store('merchantImages');
        return $this;
    }

    public function setCompanyTaxClearanceDocument($companyTaxClearanceDocument)
    {
        $this->companyTaxClearanceDocument = $companyTaxClearanceDocument->store('merchantImages');
        return $this;
    }

    public function uploadImage()
    {
        try {
            $images = $this->apiParams;
            Log::info('Uploaded Images', $images);
            $client = new Client();
            $response = $client->request($this->httpMethod, $this->baseUrl . $this->url, [
                'multipart' => $images
            ]);
            return $response->getBody()->getContents();
        }
        catch (\Exception $e) {
            Log::info("Unknown Exception");
            Log::info($e);
            return "Other Error";
        }
    }


}
