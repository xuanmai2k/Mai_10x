<?php

namespace App\Listeners;

use App\Events\AppointmentCancelEvent;
use App\Mail\CancelDoctorEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailToDoctorWhenAppointmentCancel
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
    public function handle(AppointmentCancelEvent $event): void
    {
        $appointment = $event->appointment;
        Mail::to($appointment->doctor->email)->send(new CancelDoctorEmail($appointment));
    }
}
