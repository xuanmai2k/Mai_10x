<?php

namespace App\Console\Commands;

use App\Events\AppointmentCancelEvent;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Appointment;

class overtimeAppointment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:overtime-appointment';

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
        $yesterday = Carbon::now()->timezone('Asia/Ho_Chi_Minh');
        $appointments = Appointment::where('date_appointment','<=', $yesterday->toDateString())->where('status', 1)->get();
        foreach( $appointments as $appointment){
            event(new AppointmentCancelEvent($appointment));
        }
        $this->info('Cancelled ' . count($appointments) . ' missed bookings.');
    }

}
