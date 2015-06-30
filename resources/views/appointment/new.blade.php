@extends('layouts.master')

@section('content')
    <div class="col-md-4 col-lg-4">
    <div class="panel panel-default">
        <div class="panel-heading">New appointment</div>
        <div class="panel-body">
            @unless ($errors->isEmpty())
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </div>
            @endunless
            {!! Form::model($appointment, array('route' => 'appointment.store')) !!}
                <div class="form-group">
                      {!! Form::label('name', 'Name') !!}
                      {!! Form::text('name', null, array('class' => 'form-control',
                                                           'placeholder' => 'Name',
                                                           'type' => 'text')) !!}
                </div>

                <div class="form-group">
                      {!! Form::label('phoneNumber', 'Phone number') !!}
                      {!! Form::text('phoneNumber', null, array('class' => 'form-control',
                                                          'placeholder' => 'Phone number',
                                                          'type' => 'tel')) !!}
                </div>
                <div class="form-group">
                      {!! Form::label('when', 'Appointment time') !!}
                      {!! Form::text('when', null, array('class' => 'form-control',
                                                           'placeholder' => 'Time of appointment',
                                                           'type' => 'text', 'id' => 'time-of-appointment')) !!}
                </div>
                <div class="form-group">
                      {!! Form::label('delta', 'Notification time') !!}
                      {!! Form::select('delta', array('15' => '15 minutes', '30' => '30 minutes', '60' => 'One hour'),
                                               array('class' => 'form-control', 'placeholder' => 'Time before appointment',
                                                     'id' => 'delta')) !!}
                </div>
                <div class="form-group">
                    <div class="controls">
                        <button type="submit" href="#" class="btn btn-primary">Add</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    </div>
@stop

@section('scripts')
    <script src="{{  URL::asset('js/datetime-picker.js') }}"></script>
@stop
