<?php

namespace App\Http\Controllers;

use App\Events\SaveFCMNotificationEvent;
use App\Events\SendFcmNotification;
use App\Events\SendFcmTopicNotification;
use App\Models\FCMNotification;
use App\Models\User;
use App\Wallet\Notification\Repository\NotificationRepository;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    private $repository;

    public function __construct(NotificationRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function view()
    {
        $notifications = $this->repository->latestNotifications();
        return view('admin.notification.view')->with(compact('notifications'));
    }

    public function create(Request $request)
    {
        if ($this->repository->notificationService() == NotificationRepository::SERVICE_ONE_SIGNAL) {
            $allTopics = array_map(function ($arr) {return $arr["title"];}, config('onesignal.tags'));
        } else {
            $allTopics = config('fcm.topics');
        }
        if ($request->isMethod('post')) {
            if (empty($request->topics)) {
                return redirect()->back()->with('error', 'Topic not selected');
            }

            $this->repository->sendTopicNotification();

            if (!$this->repository->createTopicNotifications()) {
                return redirect()->route('notification.view')->with('error', 'notification not sent successfully');
            }

            return redirect()->route('notification.view')->with('success', 'notification sent successfully');
        }

        return view('admin.notification.create')->with(compact('allTopics'));
    }

    public function userNotification(User $user)
    {
        if (!$this->repository->checkUserTokens($user)) {
            return redirect()->back()->with('error', 'Notification token not found');
        }

        $this->repository->sendUserNotification($user);

        if (!$this->repository->createUserNotification($user)) {
            return redirect(route('user.profile', $user->id))->with('error', 'Notification not sent successfully');
        }

        return redirect(route('user.profile', $user->id))->with('success', 'Notification sent successfully');
    }


}
