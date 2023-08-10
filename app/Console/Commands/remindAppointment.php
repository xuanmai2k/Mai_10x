<?php

namespace App\Console\Commands;

use App\Events\AppointmentCancelEvent;
use App\Events\RemindAppointmentEvent;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class remindAppointment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remind-appointment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::now()->addDay()->timezone('Asia/Ho_Chi_Minh');
        $appointments = Appointment::where('date_appointment', $tomorrow->toDateString())->where('status', 1)->get();
        foreach( $appointments as $appointment){
            event(new RemindAppointmentEvent($appointment));
        }
        $this->info('Remind ' . count($appointments) . ' bookings.');

        // $appointments = cache()->pull('filtered_records');
        // foreach( $appointments as $appointment){
        //     event(new RemindAppointmentEvent($appointment));
        // }
        // // $cache = cache()->has('filtered_records');
        // $this->info('Remind ' . count($appointments) . ' bookings.');

    }
}
