<?php

namespace App\Providers;

use App\Events\FileuploadRejectionEvent;
use App\Events\MembershipRequestEvent;
use App\Events\NewStudentNonRegistrantEvent;
use App\Events\UpdateScoreSummaryEvent;
use App\Events\SubscriberPasswordResetEvent;
use App\Events\UpdateAuditionStatusEvent;
use App\Events\UpdateRegistrantStatusEvent;
use App\Listeners\FileuploadRejectionStudentEmailListener;
use App\Listeners\NewNonStudentNonRegistrantListener;
use App\Listeners\SendMembershipRequestEmailListener;
use App\Listeners\SubscriberResetPasswordEmailListener;
use App\Listeners\UpdateAuditionStatusListener;
use App\Listeners\UpdateRegistrantStatusListener;
use App\Listeners\UpdateScoreSummaryListener;
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
        MembershipRequestEvent::class => [
            SendMembershipRequestEmailListener::class,
        ],
        FileuploadRejectionEvent::class => [
            FileuploadRejectionStudentEmailListener::class,
        ],
        NewStudentNonRegistrantEvent::class => [
            NewNonStudentNonRegistrantListener::class,
        ],
        UpdateRegistrantStatusEvent::class => [
            UpdateRegistrantStatusListener::class,
        ],
        SubscriberPasswordResetEvent::class =>[
            SubscriberResetPasswordEmailListener::class,
        ],
        UpdateAuditionStatusEvent::class => [
          UpdateAuditionStatusListener::class,
        ],
        UpdateScoreSummaryEvent::class => [
            UpdateScoreSummaryListener::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
