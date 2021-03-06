<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/calendar', function () {
    return view('EventPage');
});

Route::post('/event/insert', 'EventController@insertEvent');
Route::post('/event/select', 'EventController@selectEvent');
