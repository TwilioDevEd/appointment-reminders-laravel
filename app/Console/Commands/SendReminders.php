<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders using Twilio';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $twilioConfig = config('services.twilio');
        $accountSid = $twilioConfig['twilio_account_sid'];
        $authToken = $twilioConfig['twilio_auth_token'];
        $sendingNumber = $twilioConfig['twilio_sending_number'];
        $twilioClient = new \Services_Twilio($accountSid, $authToken);

        $allAppointments = \App\Appointment::all();
        $appointmentsFinder = new \App\AppointmentReminders\AppointmentFinder($allAppointments);
        $matchingAppointments = $appointmentsFinder->findMatchingAppointments();
        $appointmentReminder = new \App\AppointmentReminders\AppointmentReminder(
            $matchingAppointments,
            $sendingNumber,
            $twilioClient->account->messages
        );

        $appointmentReminder->sendReminders();
    }
}
