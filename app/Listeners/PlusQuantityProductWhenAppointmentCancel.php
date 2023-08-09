<?php

namespace App\Listeners;

use App\Events\AppointmentCancelEvent;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PlusQuantityProductWhenAppointmentCancel
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
        $product = Product::find($appointment->product_id);
        $product->qty = $product->qty + 1;
        $product->save();
    }
}
