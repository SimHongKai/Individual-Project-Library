<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;

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
        // set point limits to 0 weekly
        $schedule->call(function () {
            DB::table('users')->update(['weekly_points' => 0]);
        })->everyMinute(); //weekly()

        // runs the expire Bookings cancel every day
        $schedule->call('\App\Http\Controllers\BookingController@cancelExpiredBookings')->everyMinute()->evenInMaintenanceMode();
        // daily
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
