@extends('layouts.master')

@section('content')
    @include('appointment._form', array('heading' => 'Edit appointment',
                                        'route' => array('appointment.update', $appointment->id),
                                        'submitText' => 'Edit',
                                        'method' => 'PUT'))
@stop

@section('scripts')
    <script src="{{  URL::asset('js/datetime-picker.js') }}"></script>
@stop