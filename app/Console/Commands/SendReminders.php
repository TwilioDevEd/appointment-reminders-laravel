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
    protected $description = 'Command description.';

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
     * @return mixed
     */
    public function handle()
    {
        $accountSid = config('app.twilio_account_sid');
        $authToken = config('app.twilio_auth_token');
        $sendingNumber = config('app.twilio_sending_number');
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
