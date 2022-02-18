<?php


namespace App\Wallet;


use Illuminate\Support\Facades\Log;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;

class FCMTopicNotifier
{
    protected $title;

    protected $body;

    protected $description;

    protected $topic;

    public function __construct($title, $body, $description, $topic)
    {
        $this->title = $title;
        $this->body = $body;
        $this->description = $description;
        $this->topic = $topic;
    }

    public function send()
    {
        try {
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);

            $notificationBuilder = new PayloadNotificationBuilder($this->title);
            $notificationBuilder->setBody($this->description)
                ->setImage($this->body["image"] ?? null)
                ->setSound('default')
                ->setChannelId('12345');

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData($this->body);

            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();


            foreach ($this->topic as $topicData) {
                $topic = new Topics();
                $topic->topic($topicData);
                FCM::sendToTopic($topic, $option, $notification, $data);
            }

            Log::debug("Notification Sent to topic");
            Log::info($this->topic);
        }catch (Exception $e) {
            Log::debug("Error while sending notification");
            Log::error($e, ['context' => $this]);
        }
    }
}
