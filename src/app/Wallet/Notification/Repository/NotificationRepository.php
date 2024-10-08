<?php


namespace App\Wallet\Notification\Repository;


use App\Broadcasting\AakashSMSChannel;
use App\Broadcasting\FCMChannel;
use App\Broadcasting\MiracleInfoChannel;
use App\Broadcasting\OneSignalChannel;
use App\Broadcasting\SparrowChannel;
use App\Events\SendFcmNotification;
use App\Events\SendFcmTopicNotification;
use App\Models\FCMNotification;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\FCMTopicNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class NotificationRepository
{
    private $request;

    private $length = 15;

    CONST SERVICE_FIREBASE = 'FIREBASE';
    CONST SERVICE_ONE_SIGNAL = 'ONE SIGNAL';

    CONST SMS_SPARROW = 'SPARROW SMS';
    CONST SMS_MIRACLE = 'MIRACLE SMS';
    CONST SMS_AAKASH = 'AAKASH SMS';

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param int $length
     * @return NotificationRepository
     */
    public function setLength(int $length): NotificationRepository
    {
        $this->length = $length;
        return $this;
    }

    public function smsService()
    {
        return Setting::where('option', 'sms_service')->first()->value;
    }

    public function smsChannel()
    {
        if ($this->smsService() == self::SMS_SPARROW) {
            return SparrowChannel::class;
        }

        elseif ($this->smsService() == self::SMS_MIRACLE) {
            return MiracleInfoChannel::class;
        }

        elseif ($this->smsService() == self::SMS_AAKASH) {
            return AakashSMSChannel::class;

        }else{
            return SparrowChannel::class;
        }
    }

    public function notificationService()
    {
        return Setting::where('option', 'notification_service')->first()->value;
    }

    public function notificationChannel()
    {
        if ($this->notificationService() == self::SERVICE_FIREBASE) {
            return FCMChannel::class;
        }

        if ($this->notificationService() == self::SERVICE_ONE_SIGNAL) {
            return OneSignalChannel::class;
        }
    }

    public function latestNotifications()
    {
        return FCMNotification::with('user', 'admin')->latest()->filter($this->request)->paginate($this->length);
    }

    public function checkUserTokens($user)
    {
        $token = $user->fcm_token;
        $desktopToken = $user->desktop_fcm;

        if ((!$token || strtolower($token) ===  "no fcm") && (!$desktopToken || strtolower($desktopToken) === "no fcm")) {
            return false;
        }
        return true;
    }

    public function sendUserNotification(User $user, $responseData)
    {
        $imageUrl = null;
        if (isset($responseData['image'])) {
            $imageUrl = config('dpaisa-api-url.public_document_url').$responseData['image'];
        }

        $user->notify(new \App\Notifications\FCMNotification(
                $user,
                $responseData['title'],
                $responseData['message'],
                'Single user notification',
            $imageUrl,
            ));
        //event(new SendFcmNotification($user, $this->request->title, $this->request->message, ['a_data' => 'my_data'], 'Single user notification'));
    }

    public function createUserNotification($user,$responseData)
    {
        $imageUrl = null;
        if (isset($responseData['image'])) {
            $imageUrl = config('dpaisa-api-url.public_document_url').$responseData['image'];
        }
        $notificationRequest = [
            'user_id' => $user->id,
            'title' => $this->request->title,
            'message' => $this->request->message,
            'data' => json_encode(['a_data' => 'my_data']),
            'notification_type' => 'Single user notification',
            'backend_user_id' => auth()->user()->id,
            'image' => $imageUrl,
        ];

        try {
            FCMNotification::create($notificationRequest);
            return true;
        } catch (\Exception $e) {
            Log::debug('Error while saving user notification to table');
            Log::error($e, ['context' => $notificationRequest]);
            return false;
        }
    }

    public function sendTopicNotification($responseData)
    {
        $topics = array_merge($responseData['topics'], $responseData['district_topics'] ?? []);
        $title = $responseData['title'];
        $message = $responseData['message'];
        $imageUrl = null;
        if (isset($responseData['image'])) {
            $imageUrl = config('dpaisa-api-url.public_document_url').$responseData['image'];
        }
        (new User())->notify(new FCMTopicNotification($topics, $title, $message, 'TOPIC NOTIFICATION',$imageUrl));

        //event(new SendFcmTopicNotification($topics, $title, $message, [$title => $message], 'TOPIC NOTIFICATION'));
    }

    public function createTopicNotifications($responseData)
    {
        $imageUrl = null;
        if (isset($responseData['image'])) {
            $imageUrl = config('dpaisa-api-url.public_document_url').$responseData['image'];
        }
        $allTopics = array_merge($this->request->topics, $this->request->district_topics ?? []);
        foreach ($allTopics as $topic) {
            $notificationRequest = [
                'user_id' => '',
                'title' => $this->request->title,
                'message' => $this->request->message,
                'data' => json_encode(['a_data' => 'my_data']),
                'notification_type' => $topic,
                'backend_user_id' => auth()->user()->id,
                'image' => $imageUrl,
            ];

            try {
                FCMNotification::create($notificationRequest);
            } catch (\Exception $e) {
                Log::debug('Error while creating topic notification');
                Log::error($e, ['context' => $this->request->topic, 'topic' => $topic]);
                return false;
            }
        }

        return true;
    }
}
