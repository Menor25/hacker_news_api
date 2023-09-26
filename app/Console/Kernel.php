<?php

namespace App\Console;

use App\Jobs\SpoolAsks;
use App\Jobs\SpoolJobs;
use App\Jobs\SpoolStories;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->job(new SpoolAsks)->everyTwelveHours();
        $schedule->job(new SpoolStories)->everyTwelveHours();
        $schedule->job(new SpoolJobs)->everyTwelveHours();
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
