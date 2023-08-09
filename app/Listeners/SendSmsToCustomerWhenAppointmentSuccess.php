<?php

namespace App\Listeners;

use App\Events\AppointmentSuccessEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSmsToCustomerWhenAppointmentSuccess
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
        $receivedNumber = '+84' . ltrim($appointment->phone, '0') ;
        // $receivedNumber = '+84783362649';
        $client = new \Twilio\Rest\Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
        $client->messages->create($receivedNumber, [
            'from' => env('TWILIO_PHONE_NUMBER'),
            'body' => 'confirm'
        ]);
    }
}
