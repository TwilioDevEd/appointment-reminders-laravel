<?php

namespace App\AppointmentReminders;

use Illuminate\Log;

class AppointmentReminder
{
    /**
     * Construct a new AppointmentReminder
     *
     * @param Illuminate\Database\Eloquent\Collection Collection of appointments
     */
    function __construct($appointments) {
        $this->appointments = $appointments;
    }

    /**
     * Send reminders for each appointment
     *
     * @return void
     */
    public function sendReminders() {
        $this->appointments->each(function($appointment) {
            $this->remindAbout($appointment);
        });
    }

    private function remindAbout($appointment) {
        // Write appointment logic here
    }
}