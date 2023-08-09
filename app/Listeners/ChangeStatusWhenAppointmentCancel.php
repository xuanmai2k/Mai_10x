<?php

namespace App\Listeners;

use App\Events\AppointmentCancelEvent;
use App\Models\Appointment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangeStatusWhenAppointmentCancel
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
        $check = Appointment::find($appointment->id);
        $check->status = 3;
        $check->save();
    }
}
