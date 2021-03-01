<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;

class SendFcmTopicNotificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    private function dataResolver($event)
    {
        if ($event->notification_type) {
            return array_merge(["type" => $event->notification_type], $event->data);
        }
        return $event->data;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        try {
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);

            $notificationBuilder = new PayloadNotificationBuilder($event->title);
            $notificationBuilder->setBody($event->message)
                ->setSound('default')
                ->setChannelId('12345');

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData($this->dataResolver($event));

            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();


            foreach ($event->topics as $topicData) {
                $topic = new Topics();
                $topic->topic($topicData);
                FCM::sendToTopic($topic, $option, $notification, $data);
            }

            Log::debug("Notification Sent to topic");
            Log::info($event->topics);
        }catch (Exception $e) {
            Log::debug("Error while sending notification");
            Log::error($e, ['context' => $event]);
        }
    }
}
