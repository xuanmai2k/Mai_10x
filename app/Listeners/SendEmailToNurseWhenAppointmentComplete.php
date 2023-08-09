<?php

namespace App\Listeners;

use App\Events\AppointmentCompleteEvent;
use App\Mail\CompleteNurseEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailToNurseWhenAppointmentComplete
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
        Mail::to($appointment->nurse->email)->send(new CompleteNurseEmail($appointment));
    }
}
