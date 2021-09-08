<?php


namespace App\Wallet\Notification\Repository;


use App\Broadcasting\FCMChannel;
use App\Broadcasting\OneSignalChannel;
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
        $user->notify(new \App\Notifications\FCMNotification(
                $user,
                $responseData['title'],
                $responseData['message'],
                'Single user notification',
            config('dpaisa-api-url.public_document_url').$responseData['image']
            ));
        //event(new SendFcmNotification($user, $this->request->title, $this->request->message, ['a_data' => 'my_data'], 'Single user notification'));
    }

    public function createUserNotification($user)
    {
        $notificationRequest = [
            'user_id' => $user->id,
            'title' => $this->request->title,
            'message' => $this->request->message,
            'data' => json_encode(['a_data' => 'my_data']),
            'notification_type' => 'Single user notification',
            'backend_user_id' => auth()->user()->id
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
        $topics = $responseData['topics'];
        $title = $responseData['title'];
        $message = $responseData['message'];
        $imageUrl = config('dpaisa-api-url.public_document_url').$responseData['image'];

        (new User())->notify(new FCMTopicNotification($topics, $title, $message, 'TOPIC NOTIFICATION',$imageUrl));

        //event(new SendFcmTopicNotification($topics, $title, $message, [$title => $message], 'TOPIC NOTIFICATION'));
    }

    public function createTopicNotifications()
    {
        foreach ($this->request->topics as $topic) {

            $notificationRequest = [
                'user_id' => '',
                'title' => $this->request->title,
                'message' => $this->request->message,
                'data' => json_encode(['a_data' => 'my_data']),
                'notification_type' => $topic,
                'backend_user_id' => auth()->user()->id
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
