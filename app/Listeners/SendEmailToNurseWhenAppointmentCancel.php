<?php

namespace App\Listeners;

use App\Events\AppointmentCancelEvent;
use App\Mail\CancelNurseEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailToNurseWhenAppointmentCancel
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
        Mail::to($appointment->nurse->email)->send(new CancelNurseEmail($appointment));
    }
}
