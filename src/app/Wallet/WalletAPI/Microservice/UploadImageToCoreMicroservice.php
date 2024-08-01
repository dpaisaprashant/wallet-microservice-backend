<?php


namespace App\Wallet\WalletAPI\Microservice;


use App\Wallet\WalletAPI\BackendWalletAPIJSONAbstract;
use Illuminate\Http\Request;

class UploadImageToCoreMicroservice extends BackendWalletAPIJSONAbstract
{
    protected $image;
    protected $disk;
    protected $upload_location;
    protected $public_location;


    public function __construct($image, $disk = null)
    {
        $this->image = $image;
        $this->disk = $disk;
    }

    public function setDisk($disk)
    {
        $this->disk = $disk;
        return $this;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @param mixed $upload_location
     * @return UploadImageToCoreMicroservice
     */
    public function setUploadLocation($upload_location)
    {
        $this->upload_location = $upload_location;
        return $this;
    }

    /**
     * @param mixed $public_location
     * @return UploadImageToCoreMicroservice
     */
    public function setPublicLocation($public_location)
    {
        $this->public_location = $public_location;
        return $this;
    }



    public function processRequest()
    {
        $this->addParam('image',$this->image)
            ->addParam('disk',$this->disk)
            ->addParam('upload_location',$this->upload_location)
            ->addParam('public_location',$this->public_location);
        $this->setBaseUrl(config('UploadFilesToCore.'."base_url"));
        $this->setUrl(config('UploadFilesToCore.'."url"));
    }

    public function uploadImageToCore()
    {
        $this->processRequest();
        $response = $this->uploadImage();
        //dd($response);
        return $response;
    }
}
