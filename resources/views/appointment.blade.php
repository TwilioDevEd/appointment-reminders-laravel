@extends('layouts.master')

@section('content')
    <div class="col-md-4 col-lg-4">
    <div class="panel panel-default">
        <div class="panel-heading">New appointment</div>
        <div class="panel-body">
            <?php echo Form::model($appointment, array('route' => 'appointment.store')) ?>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <div class="input-group"> <?php echo Form::text('name', null, array('class' => 'form-control',
                                                                            'placeholder' => 'Name',
                                                                            'type' => 'text')) ?> </div>
            </div>

            <div class="form-group">
                <div class="input-group"> <?php echo Form::text('phone', null, array('class' => 'form-control',
                                                                             'placeholder' => 'Phone number',
                                                                             'type' => 'tel')) ?> </div>
            </div>
            <div class="form-group">
                <div class="input-group"> <?php echo Form::text('when', null, array('class' => 'form-control',
                                                                             'placeholder' => 'Time of appointment',
                                                                             'type' => 'text', 'id' => 'time-of-appointment')) ?> </div>
            </div>
            <div class="form-group">
                <div class="controls">
                    <button type="submit" href="#" class="btn btn-primary">Add</button>
                </div>
            </div>
            <?php echo Form::close() ?>
        </div>
    </div>
    </div>
@stop

@section('scripts')
    <script src="{{  URL::asset('js/datetime-picker.js') }}"></script>
@stop
