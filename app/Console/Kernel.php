<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\SyncDokterFromAPI;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        SyncDokterFromAPI::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('app:sync-poli-from-a-p-i')->everyFiveMinutes();
        $schedule->command('sync:dokter-api')->everyFiveMinutes();
        $schedule->command('app:sync-perawat-from-a-p-i')->everyFiveMinutes();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
