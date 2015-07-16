<?php

use Illuminate\Support\Collection;

class AppointmentReminderTest extends TestCase
{
    public function setUp()
    {
        $appointmentOne = new \App\Appointment;

        $appointmentOne->name = 'Martin Fowler';
        $appointmentOne->phoneNumber = '6692216251';
        $appointmentOne->when = '2015-05-05T10:20:00.000Z';
        $appointmentOne->delta = '15';
        $appointmentOne->timezoneOffset = '360';
        $this->messageBodyOne = "Hello Martin Fowler, this is a reminder that you have an appointment in 15 minutes! That is 4:20am!";

        $appointmentTwo = new \App\Appointment;

        $appointmentTwo->name = 'Kent Beck';
        $appointmentTwo->phoneNumber = '4893516251';
        $appointmentTwo->when = '2015-05-05T11:20:00.000Z';
        $appointmentTwo->delta = '15';
        $appointmentTwo->timezoneOffset = '360';
        $this->messageBodyTwo = "Hello Kent Beck, this is a reminder that you have an appointment in 15 minutes! That is 5:20am!";

        $this->appointments = Collection::make([$appointmentOne, $appointmentTwo]);
    }

    public function testAppointmentReminder()
    {
        $numbers = Collection::make(['6692216251', '4893516251']);
        $messages = Collection::make([$this->messageBodyOne, $this->messageBodyTwo]);

        $twilioServiceMock = \Mockery::mock('TwilioServiceMock');
        $twilioServiceMock->shouldReceive('create').with(
            \Mockery::on(
                function ($number, $content) {
                    $this->assertTrue($numbers->contain($number));
                    $this->assertTrue($messages->contain($content));
                    return true;
                }
            )
        );

        $reminder = new \App\AppointmentReminders\AppointmentReminder(
            $this->appointments, '+5555555555', $twilioServiceMock
        );

        $reminder->sendReminders();
    }

}