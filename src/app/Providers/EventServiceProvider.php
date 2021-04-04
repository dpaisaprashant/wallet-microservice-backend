<?php

namespace App\Providers;

use App\Events\DisputeHandledEvent;
use App\Events\LoadTestFundEvent;
use App\Events\NpayToDpaisaTransactionExcelUpload;
use App\Events\PaypointToDpaisaTransactionExcelUpload;
use App\Events\SaveFCMNotificationEvent;
use App\Events\SendFcmNotification;
use App\Events\SendFcmTopicNotification;
use App\Events\SendOTPCodeEvent;
use App\Events\UserBonusWalletPaymentEvent;
use App\Events\UserBonusWalletUpdateEvent;
use App\Events\UserWalletPaymentEvent;
use App\Events\UserWalletUpdateEvent;
use App\Listeners\DisputeHandledListener;
use App\Listeners\LoadTestFundListener;
use App\Listeners\NpayToDpaisaTransactionExcelUploadListener;
use App\Listeners\PaypointToDpaisaTransactionExcelUploadListener;
use App\Listeners\SaveFCMNotificationListener;
use App\Listeners\SendFcmNotificationListener;
use App\Listeners\SendFcmTopicNotificationListener;
use App\Listeners\SendOTPCodeListener;
use App\Listeners\UserBonusWalletPaymentListener;
use App\Listeners\UserBonusWalletUpdateListener;
use App\Listeners\UserWalletPaymentListener;
use App\Listeners\UserWalletUpdateListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        SendFcmNotification::class => [
            SendFcmNotificationListener::class
        ],

        SendFcmTopicNotification::class => [
            SendFcmTopicNotificationListener::class
        ],

        SendOTPCodeEvent::class => [
            SendOTPCodeListener::class
        ],

        SaveFCMNotificationEvent::class => [
            SaveFCMNotificationListener::class
        ],

        PaypointToDpaisaTransactionExcelUpload::class => [
          PaypointToDpaisaTransactionExcelUploadListener::class
        ],

        NpayToDpaisaTransactionExcelUpload::class => [
          NpayToDpaisaTransactionExcelUploadListener::class
        ],

        UserWalletUpdateEvent::class => [
          UserWalletUpdateListener::class
        ],

        UserWalletPaymentEvent::class => [
          UserWalletPaymentListener::class
        ],

        //Bonus Wallet
        UserBonusWalletUpdateEvent::class => [
            UserBonusWalletUpdateListener::class
        ],
        UserBonusWalletPaymentEvent::class => [
            UserBonusWalletPaymentListener::class
        ],

        DisputeHandledEvent::class => [
            DisputeHandledListener::class
        ],

        LoadTestFundEvent::class => [
            LoadTestFundListener::class
        ],



    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
