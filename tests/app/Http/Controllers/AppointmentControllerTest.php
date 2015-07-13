<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AppointmentControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * POST create endpoint
     *
     * @return void
     */
    public function testNewAppointment()
    {
        Session::start();
        $response = $this->call('POST', '/appointment', ['name' => 'Erich Gamma',
                                         'phoneNumber' => '6692216251',
                                         'when' => '2015-07-24T18:00:00.000Z',
                                         '_token' => csrf_token(),
                                         'delta' => '15']);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertTrue($response->isRedirect());

        $appointments = \App\Appointment::where(['name' => 'Erich Gamma'])->get();

        $this->assertCount(1, $appointments);
        $this->assertEquals('Erich Gamma', $appointments->first()['name']);
        $this->assertEquals('6692216251', $appointments->first()['phoneNumber']);
        $this->assertEquals('15', $appointments->first()['delta']);
        $this->assertEquals('2015-07-24 18:00:00', $appointments->first()['when']);
    }

    public function testNewAppointmentValidation()
    {
        Session::start();
        $response = $this->call('POST', '/appointment', ['name' => 'Erich Gamma',
                                         'phoneNumber' => '',
                                         'when' => '2015-07-24T18:00:00.000Z',
                                         '_token' => csrf_token(),
                                         'delta' => '15']);

        $appointments = \App\Appointment::where(['name' => 'Erich Gamma'])->get();
        $this->assertCount(0, $appointments);
    }

    public function testAppointmentIndex()
    {
        $response = $this->call('GET', '/appointment');
        $this->assertTrue($response->isOk());
    }

    public function testDestroyAppointment()
    {
        Session::start();
        $newAppointment = new \App\Appointment;

        $newAppointment->name = 'Martin Fowler';
        $newAppointment->phoneNumber = '6692216251';
        $newAppointment->when = '2015-07-24T18:00:00.000Z';
        $newAppointment->delta = '15';
        $newAppointment->save();

        $idToDelete = $newAppointment->id;

        $appointments = \App\Appointment::where(['name' => 'Martin Fowler'])->get();
        $this->assertCount(1, $appointments);

        $this->call('DELETE', '/appointment/' . $idToDelete, ['_token' => csrf_token()]);

        $appointments = \App\Appointment::where(['name' => 'Martin Fowler'])->get();
        $this->assertCount(0, $appointments);
    }
}
