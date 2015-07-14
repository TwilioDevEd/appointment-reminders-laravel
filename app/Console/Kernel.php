<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function() {
            $allAppointments = \App\Appointment::all();
            $appointmentsFinder = new \App\AppointmentReminders\AppointmentFinder($allAppointments);
            $matchingAppointments = $appointmentsFinder->findMatchingAppointments();
            $appointmentReminder = new \App\AppointmentReminders\AppointmentReminder($matchingAppointments);

            $appointmentReminder->sendReminders();
        })->everyTenMinutes();
    }
}
