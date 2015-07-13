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
        $recipientName = $appointment->name;
        $appointmentDelta = $appointment->delta;

        $message = "Hello $recipientName, this is a reminder that you have an appointment in $appointmentDelta minutes!";
        $this->sendMessage($appointment->phoneNumber, $message);
    }

    private function sendMessage($number, $content) {
        $accountSid = config('app.twilio_account_sid');
        $authToken= config('app.twilio_auth_token');
        $sendingNumber = config('app.twilio_sending_number');

        $client = new \Services_Twilio($accountSid, $authToken);
        $client->account->messages->create(array(
            "From" => $sendingNumber,
            "To" => $number,
            "Body" => $content
        ));
    }
}