<?php

namespace App\Providers;

use App\Events\AppointmentCancelEvent;
use App\Events\AppointmentCompleteEvent;
use App\Events\AppointmentSuccessEvent;
use App\Listeners\ChangeStatusPaymentWhenAppointmentCancel;
use App\Listeners\ChangeStatusWhenAppointmentCancel;
use App\Listeners\ChangeStatusWhenAppointmentComplete;
use App\Listeners\MinusQuantityProductWhenAppointmentSuccess;
use App\Listeners\PlusQuantityProductWhenAppointmentCancel;
use App\Listeners\SendEmailToCustomerWhenAppointmentCancel;
use App\Listeners\SendEmailToCustomerWhenAppointmentComplete;
use App\Listeners\SendEmailToCustomerWhenAppointmentSuccess;
use App\Listeners\SendEmailToDoctorWhenAppointmentCancel;
use App\Listeners\SendEmailToDoctorWhenAppointmentComplete;
use App\Listeners\SendEmailToDoctorWhenAppointmentSuccess;
use App\Listeners\SendEmailToNurseWhenAppointmentCancel;
use App\Listeners\SendEmailToNurseWhenAppointmentComplete;
use App\Listeners\SendEmailToNurseWhenAppointmentSuccess;
use App\Listeners\SendSmsToCustomerWhenAppointmentCancel;
use App\Listeners\SendSmsToCustomerWhenAppointmentComplete;
use App\Listeners\SendSmsToCustomerWhenAppointmentSuccess;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AppointmentSuccessEvent::class => [
            SendEmailToCustomerWhenAppointmentSuccess::class,
            SendEmailToDoctorWhenAppointmentSuccess::class,
            SendEmailToNurseWhenAppointmentSuccess::class,
            MinusQuantityProductWhenAppointmentSuccess::class,
            // SendSmsToCustomerWhenAppointmentSuccess::class,
        ],
        AppointmentCompleteEvent::class => [
            ChangeStatusWhenAppointmentComplete::class,
            SendEmailToCustomerWhenAppointmentComplete::class,
            SendEmailToDoctorWhenAppointmentComplete::class,
            SendEmailToNurseWhenAppointmentComplete::class,
            // SendSmsToCustomerWhenAppointmentComplete::class,
        ],
        AppointmentCancelEvent::class => [
            ChangeStatusWhenAppointmentCancel::class,
            ChangeStatusPaymentWhenAppointmentCancel::class,
            SendEmailToCustomerWhenAppointmentCancel::class,
            SendEmailToDoctorWhenAppointmentCancel::class,
            SendEmailToNurseWhenAppointmentCancel::class,
            PlusQuantityProductWhenAppointmentCancel::class,
            // SendSmsToCustomerWhenAppointmentCancel::class,
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
