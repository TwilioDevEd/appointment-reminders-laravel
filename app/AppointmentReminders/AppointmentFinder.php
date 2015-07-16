<?php

namespace App\AppointmentReminders;

use Carbon\Carbon;

class AppointmentFinder
{
    /**
     * Construct a new AppointmentFinder
     *
     * @param Illuminate\Database\Eloquent\Collection Collection of appointments
     */
    function __construct($appointments) {
        $this->appointments = $appointments;
    }

    /**
     * Find appointments with a reminder within the next minute
     *
     * @return Illuminate\Database\Eloquent\Collection Collection of appointments that
     *         must be reminded within a minute
     */
    public function findMatchingAppointments() {
        $appointmentsToRemind = $this->appointments->filter(
            function ($appointment) {
                return $this->isAppointmentWithinAMinute($appointment);
            }
        );

        return $appointmentsToRemind;
    }

    private function isAppointmentWithinAMinute($appointment) {
        $now = Carbon::now();
        $inTenMinutes = Carbon::now()->addMinutes(10);
        $appointmentTime = Carbon::parse($appointment->when, 'UTC');
        $appointmentReminderTime = $appointmentTime->subMinutes($appointment->delta);

        return $appointmentReminderTime->between($now, $inTenMinutes);
    }

}