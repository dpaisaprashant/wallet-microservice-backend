<?php


namespace App\Wallet;


use Illuminate\Support\Facades\Log;

class OneSignalTagNotifier
{
    protected $title;

    protected $body;

    protected $description;

    protected $tags = [];

    /**
     * @param mixed $title
     * @return OneSignalTagNotifier
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param mixed $body
     * @return OneSignalTagNotifier
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @param mixed $description
     * @return OneSignalTagNotifier
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param array $tags
     * @return OneSignalTagNotifier
     */
    public function setTags(array $tags): OneSignalTagNotifier
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Initialize the notifier
     *
     * @param string $title
     * @param string $description
     * @param array $body
     * @param array $tags
     */
    public function __construct($title = '', $description = '', $body = [], $tags = [])
    {
        $this->title = $title;
        $this->description = $description;
        $this->body = $body;
        $this->tags = $tags;
    }

    public function send()
    {
        foreach ($this->tags as $tag) {
            $filter = config('onesignal.tags')[$tag]['filter'];
            Log::info("Notification: " . $tag);

            $content = [
                "en" => $this->description
            ];

            $fields = [
                'app_id' => config('onesignal.app_id'),
                //'include_external_user_ids' => [$this->token],
                'filters' => [ $filter ],
                'data' => $this->body,
                'contents' => $content,
                'headings' => ["en" => $this->title],
            ];

            Log::info("OneSignal Notification", ["fields" => $fields]);
            $fields = json_encode($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, config('onesignal.url'));
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
            //return $response;
        }


    }


}
