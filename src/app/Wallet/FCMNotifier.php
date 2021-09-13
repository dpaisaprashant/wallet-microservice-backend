<?php


namespace App\Wallet;


use Illuminate\Support\Facades\Log;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class FCMNotifier
{
    /**
     * Title of the notification
     *
     * @var string
     */
    protected $title;

    /**
     * Body of the notification
     *
     * @var array
     */
    protected $body;

    /**
     * Short Description of the notification
     *
     * @var array
     */
    protected $description;


    protected $token;
    protected $desktop_token;
    /**
     * Set the title
     *
     * @param string $title
     * @return FCMNotifier
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    /**
     * Set the description
     *
     * @param string $description
     * @return FCMNotifier
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Set the contents of body
     *
     * @param array $title
     * @return FCMNotifier
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Initialize the notifier
     *
     * @param string $title
     * @param string $description
     * @param array $body
     */
    public function __construct($title, $description, $body,$token, $desktopToken)
    {
        //before: "apility/laravel-fcm": "^1.4.0",
        //now: "code-lts/laravel-fcm": "1.6.*",

        $this->title = $title;
        $this->description = $description;
        $this->body = $body;
        $this->token = $token;
        $this->desktop_token = $desktopToken;
    }

    /**
     * Send the fcm notification
     *
     * @return void
     * @throws \LaravelFCM\Message\Exceptions\InvalidOptionsException
     */
    public function send()
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($this->title);
        $notificationBuilder->setBody($this->description)
            ->setImage($this->body["image"] ?? null)
            ->setSound('default')
            ->setChannelId('12345');

        $dataBuilder = new PayloadDataBuilder();

        /*if (isset($this->body['image'])) {
            $finalData['fcm_options'] = ["image" => $this->body['image']];
        }*/

        $dataBuilder->addData($this->body);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();


        if ($this->token && strlen($this->token) > 5 && strtolower($this->token) !==  "no fcm") {
            FCM::sendTo($this->token, $option, $notification, $data);
            Log::debug("Notification to mobile, ". auth()->user()->name);
        }

        if ($this->desktop_token && strtolower($this->desktop_token) !==  "no fcm") {
            $finalData = array_merge($this->body, ["desktop" => true]);

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData($finalData);

            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();
            FCM::sendTo($this->desktop_token, $option, $notification, $data);
            Log::debug("Notification to desktop");
        }
        Log::debug("Notification");
    }
}
