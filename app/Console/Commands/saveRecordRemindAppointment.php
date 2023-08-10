<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class saveRecordRemindAppointment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:save-record-remind-appointment';

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
        cache()->put('filtered_records', $appointments, 360);
        $this->info('Save ' . count($appointments) . ' Records.');
    }
}
