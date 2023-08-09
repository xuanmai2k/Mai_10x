<?php

namespace App\Listeners;

use App\Events\AppointmentCompleteEvent;
use App\Models\Appointment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangeStatusWhenAppointmentComplete
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
        $check = Appointment::find($appointment->id);
        $check->status = 2;
        $check->status_payment = "Paid";
        $check->save();
    }
}
