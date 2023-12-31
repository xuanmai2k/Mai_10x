<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('app:overtime-appointment')->dailyAt('18:00')->timezone('Asia/Ho_Chi_Minh');
        $schedule->command('app:remind-appointment')->dailyAt('8:00')->timezone('Asia/Ho_Chi_Minh');
        // $schedule->command('app:save-record-remind-appointment')->dailyAt('3:00')->timezone('Asia/Ho_Chi_Minh');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
