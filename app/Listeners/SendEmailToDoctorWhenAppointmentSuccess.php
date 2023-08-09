<?php

namespace App\Listeners;

use App\Events\AppointmentSuccessEvent;
use App\Mail\ConfirmDoctorEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailToDoctorWhenAppointmentSuccess
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
    public function handle(AppointmentSuccessEvent $event): void
    {
        $appointment = $event->appointment;
        Mail::to($appointment->doctor->email)->send(new ConfirmDoctorEmail($appointment));
    }
}
