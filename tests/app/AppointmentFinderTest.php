<?php

use Carbon\Carbon;

class AppointmentFinderTest extends TestCase
{
    public function setUp()
    {
        $knownTime = Carbon::create(2015, 05, 05, 10, 05, 0, 'UTC');
        Carbon::setTestNow($knownTime);
    }

    public function tearDown()
    {
        Carbon::setTestNow();
    }

    public function testFindMatchingAppointments()
    {
        $appointmentToRemindAbout = new \App\Appointment;

        $appointmentToRemindAbout->name = 'Martin Fowler';
        $appointmentToRemindAbout->phoneNumber = '6692216251';
        $appointmentToRemindAbout->when = '2015-05-05T10:20:00.000Z';
        $appointmentToRemindAbout->delta = '15';

        $appointmentToNotRemindAbout = clone $appointmentToRemindAbout;
        $appointmentToNotRemindAbout->when = '2015-05-05T11:00:00.000Z';

        $appointments = collect([$appointmentToRemindAbout, $appointmentToNotRemindAbout]);

        $finder = new \App\AppointmentReminders\AppointmentFinder($appointments);

        $this->assertEquals(
            collect([$appointmentToRemindAbout]),
            $finder->findMatchingAppointments()
        );
    }

}