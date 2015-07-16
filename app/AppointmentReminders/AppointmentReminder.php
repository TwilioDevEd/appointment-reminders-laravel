<?php

namespace App\AppointmentReminders;

use Illuminate\Log;
use Carbon\Carbon;

class AppointmentReminder
{
    /**
     * Construct a new AppointmentReminder
     *
     * @param Illuminate\Support\Collection $appointments Collection of appointments
     */
    function __construct($appointments, $sendingNumber, $twilioClient)
    {
        $this->appointments = $appointments;
        $this->sendingNumber = $sendingNumber;
        $this->twilioClient = $twilioClient;
    }

    /**
     * Send reminders for each appointment
     *
     * @return void
     */
    public function sendReminders()
    {
        $this->appointments->each(
            function ($appointment) {
                $this->_remindAbout($appointment);
            }
        );
    }

    /**
     * Sends a message for an appointment
     *
     * @param Appointment $appointment The appointment to remind
     *
     * @return void
     */
    private function _remindAbout($appointment)
    {
        $recipientName = $appointment->name;
        $appointmentDelta = $appointment->delta;
        $time = Carbon::parse($appointment->when, 'UTC')->subMinutes($appointment->timezoneOffset)->format('g:i a');

        $message = "Hello $recipientName, this is a reminder that you have an appointment in $appointmentDelta minutes! That is $time!";
        $this->_sendMessage($appointment->phoneNumber, $message);
    }

    /**
     * Sends a single message using the app's global configuration
     *
     * @param string $number  The number to message
     * @param string $content The content of the message
     *
     * @return void
     */
    private function _sendMessage($number, $content)
    {
        $this->twilioClient->create(
            array(
            "From" => $this->sendingNumber,
            "To" => $number,
            "Body" => $content
            )
        );
    }
}