<?php

namespace App\Listeners;

use App\Events\AppointmentSuccessEvent;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MinusQuantityProductWhenAppointmentSuccess
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
        $product = Product::find($appointment->product_id);
        $product->qty = $product->qty - 1;
        $product->save();
    }
}
