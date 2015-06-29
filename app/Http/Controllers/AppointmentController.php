<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller
{
    private $appointment;
    private $validInputConditions = array(
        'name' => 'required',
        'phoneNumber' => 'required|min:5',
        'when' => 'required|date_format:Y/m/d H:i'
    );

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $appointment = new \App\Appointment;
        return \View::make('appointment', array('appointment' => $appointment));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $appointmentFromRequest = array('name'        => \Input::get('name'),
                                        'phoneNumber' => \Input::get('phone'),
                                        'when'        => \Input::get('when'));
        $validator = \Validator::make($appointmentFromRequest, $this->validInputConditions);

        if($validator->passes()) {
            $newAppointment = new \App\Appointment;
            $newAppointment->name = $appointmentFromRequest['name'];
            $newAppointment->phoneNumber = $appointmentFromRequest['phoneNumber'];
            $newAppointment->when= $appointmentFromRequest['when'];

            $newAppointment->save();
        }
    }
}
