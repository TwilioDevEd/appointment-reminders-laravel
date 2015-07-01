@extends('layouts.master')

@section('content')
    @include('appointment._form', array('heading' => 'Edit appointment',
                                        'actionRoute' => ['appointment.delete', $appointment->appointmentId],
                                        'submitText' => 'Edit',
                                        'method' => 'PUT'))
@stop

@section('scripts')
    <script src="{{  URL::asset('js/datetime-picker.js') }}"></script>
@stop