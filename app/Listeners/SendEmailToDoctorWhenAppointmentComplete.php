<?php

namespace App\Listeners;

use App\Events\AppointmentCompleteEvent;
use App\Mail\CompleteDoctorEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailToDoctorWhenAppointmentComplete
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
        Mail::to($appointment->doctor->email)->send(new CompleteDoctorEmail($appointment));
    }
}
