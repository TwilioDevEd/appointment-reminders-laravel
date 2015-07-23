<?php

namespace App\AppointmentReminders;

use Illuminate\Log;
use Carbon\Carbon;

class AppointmentReminder
{
    /**
     * Construct a new AppointmentReminder
     *
     * @param Illuminate\Support\Collection $twilioClient The client to use to query the API
     */
    function __construct()
    {
        $this->appointments = \App\Appointment::appointmentsDue()->get();

        $twilioConfig = config('services.twilio');
        $accountSid = $twilioConfig['twilio_account_sid'];
        $authToken = $twilioConfig['twilio_auth_token'];
        $this->sendingNumber = $twilioConfig['twilio_sending_number'];

        $this->twilioClient = new \Services_Twilio($accountSid, $authToken);
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
        $time = Carbon::parse($appointment->when, 'UTC')
              ->subMinutes($appointment->timezoneOffset)
              ->format('g:i a');

        $message = "Hello $recipientName, this is a reminder that you have an appointment at $time!";
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
        $this->twilioClient->account->messages->create(
            array(
                "From" => $this->sendingNumber,
                "To" => $number,
                "Body" => $content,
            )
        );
    }
}