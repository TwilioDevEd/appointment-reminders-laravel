@extends('layouts.master')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Phone number</th>
            <th>Appointment time</th>
            <th>Notification time</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @forelse($apts as $apt)
        <tr>
            <td> {{ $apt->name }}</td>
            <td> {{ $apt->phoneNumber }}</td>
            <td> {{ $apt->when }}</td>
            <td>{{ $apt->delta }} minute(s)</td>
            <td>
                {!! Form::open(array('route' => array('appointment.delete', $apt->id), 'method' => 'delete')) !!}
                <button type="submit" class="btn btn-danger btn-mini">Delete</button>
                {!! Form::close() !!}
            </td>
        </tr>
    @empty
        No appointments scheduled
    @endforelse
    </tbody>
</table>

@stop
