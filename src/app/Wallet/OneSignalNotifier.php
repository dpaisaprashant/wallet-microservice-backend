<?php


namespace App\Wallet;


use Illuminate\Support\Facades\Log;

class OneSignalNotifier
{
    protected $title;

    protected $body;

    protected $description;

    protected $token;

    protected $desktopToken;

    /**
     * @param mixed $title
     * @return OneSignalNotifier
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param mixed $body
     * @return OneSignalNotifier
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @param mixed $description
     * @return OneSignalNotifier
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param mixed $token
     * @return OneSignalNotifier
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @param mixed $desktopToken
     * @return OneSignalNotifier
     */
    public function setDesktopToken($desktopToken)
    {
        $this->desktopToken = $desktopToken;
        return $this;
    }

    /**
     * Initialize the notifier
     *
     * @param string $title
     * @param string $description
     * @param array $body
     * @param $token
     * @param $desktopToken
     */
    public function __construct($title='', $description='', $body=[], $token='', $desktopToken='')
    {
        $this->title = $title;
        $this->description = $description;
        $this->body = $body;
        $this->token = $token;
        $this->desktopToken = $desktopToken;
    }

    public function send()
    {
        $content = [
            "en" => $this->description
        ];

        $fields = array(
            'app_id' => config('onesignal.app_id'),
            /*'included_segments' => array(
                'All'
            ),*/
            'include_external_user_ids' => [$this->token],
            'data' => $this->body,
            'contents' => $content,
            'headings' => ["en" => $this->title],
        );

        Log::info("OneSignal Notification", ["fields" => $fields]);
        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,  config('onesignal.url'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ' . config('onesignal.auth_code')
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        Log::info($response);
        return $response;
    }

}
