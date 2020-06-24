@extends('layouts.main')

@section('content')
<h2> All appointments </h2>
@if(count($apts) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone number</th>
                <th>Appointment time (UTC)</th>
                <th>Notification time</th>
                <th>Actions</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($apts as $apt)
            <tr>
                <td> {{ $apt->name }}</td>
                <td> {{ $apt->phoneNumber }}</td>
                <td> {{ $apt->when }}</td>
                <td> {{ $apt->notificationTime }}</td>
                <td>
                    {!! Form::open(array('route' => ['appointment.destroy', $apt->id], 'method' => 'DELETE')) !!}
                        <button type="submit" class="btn btn-danger btn-mini">Delete</button>
                    {!! Form::close() !!}
                </td>
                <td>
                    {!! Html::linkRoute('appointment.edit', 'Edit', $apt->id) !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div class="well"> There are no appointments to display </div>
@endif

@stop
