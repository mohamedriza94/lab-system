<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'patient',
    'namespace' => 'App\Http\Controllers\Patient',
    'middleware' => ['web']
], function () {
    Route::get('/register', 'PageController@Register')->name('patient.register');
    Route::post('/register', 'PatientController@Register')->name('patient.register.submit');
    Route::get('/', 'LoginController@showLoginForm')->name('patient.login');
    Route::post('/', 'LoginController@validateLogin')->name('patient.login.submit');
    Route::group(['middleware' => ['auth:patient']], function () {
        Route::get('/logout', 'LoginController@logout')->name('patient.logout');
        Route::group(['prefix' => 'dashboard'], function () {

            //page routes
            Route::get('/', 'PageController@dashboard')->name('patient.dashboard');
            Route::get('/test', 'PageController@test')->name('patient.test');

            //Appointments
            Route::get('/appointments', 'AppointmentController@viewAppointments')->name('patient.appointments');
            Route::post('/bookAppointment', 'AppointmentController@bookAppointment')->name('patient.appointments.book');
            Route::post('/cancelAppointment/{id}', 'AppointmentController@cancelAppointment')->name('patient.appointments.cancel');

            //Tests
            Route::get('/tests', 'TestsController@tests')->name('patient.tests');
        });
    });
});
