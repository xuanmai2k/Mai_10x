<?php

namespace App\Listeners;

use App\Events\RemindAppointmentEvent;
use App\Mail\RemindAppointmentEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailToCustomerForRemindingAppointment
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RemindAppointmentEvent $event): void
    {
        $appointment = $event->appointment;
        Mail::to($appointment->email)->send(new RemindAppointmentEmail($appointment));
    }
}
