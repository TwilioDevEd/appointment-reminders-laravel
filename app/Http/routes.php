<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('appointment/new', ['as' => 'appointment.new', 'uses' => 'AppointmentController@create']);
Route::post('appointment', ['as' => 'appointment.store', 'uses' => 'AppointmentController@store']);
Route::get('appointment', ['as' => 'appointment.index', 'uses' => 'AppointmentController@index']);
Route::delete('appointment', ['as' => 'appointment.delete', 'uses' => 'AppointmentController@delete']);