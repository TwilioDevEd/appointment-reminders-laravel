@extends('layouts.master')

@section('content')
    <div class="panel panel-default col-lg-4 col-md-4">
        <div class="panel-body">
            <form name="form" id="form" class="form-horizontal" method="POST">

            <div class="form-group">
                <div class="input-group"> <input id="name" type="text" class="form-control" name="name" value="" placeholder="Name"> </div>
            </div>

            <div class="form-group">
                <div class="input-group"> <input id="phone" type="tel" class="form-control" name="phone" placeholder="Phone number"> </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 controls">
                    <button type="submit" href="#" class="btn btn-primary">Add</button>
                </div>
            </div>
            </form>
        </div>
    </div>
@stop