<?php

namespace App\Console;

use App\Jobs\ChangeStatusContract;
use App\Jobs\DeleteTransferPatient;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        /* $schedule->job(new ChangeStatusContract())->everyMinute();  */
        $schedule->job(new DeleteTransferPatient())->everyMinute();
        $schedule->command('appointment:reminder')->dailyAt('10:00 pm');
        $schedule->command('appointments:send')->dailyAt('09:00 pm');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
