<?php

namespace App\Listeners;

use App\Events\AppointmentCompleteEvent;
use App\Mail\ThankEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailToCustomerWhenAppointmentComplete
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
    public function handle(AppointmentCompleteEvent $event): void
    {
        $appointment = $event->appointment;
        Mail::to($appointment->email)->send(new ThankEmail($appointment));
    }
}
