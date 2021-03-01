<?php


namespace App\Wallet\Notification\Repository;


use App\Events\SendFcmNotification;
use App\Events\SendFcmTopicNotification;
use App\Models\FCMNotification;
use App\Models\User;
use App\Notifications\FCMTopicNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class NotificationRepository
{
    private $request;

    private $length = 15;

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

    public function sendUserNotification(User $user)
    {
        $user->notify(new \App\Notifications\FCMNotification(
                $user,
                $this->request->title,
                $this->request->message,
                'Single user notification'
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

    public function sendTopicNotification()
    {
        $topics = $this->request->topics;
        $title = $this->request->title;
        $message = $this->request->message;

        (new User())->notify(new FCMTopicNotification($topics, $title, $message, 'TOPIC NOTIFICATION'));

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
