<?php
use Illuminate\Support\Facades\Route;
Route::group([
    'prefix'=>'administrator',
    'namespace'=>'App\Http\Controllers\Administrator',
    'middleware'=>['web']
], function(){
    Route::get('/', 'LoginController@showLoginForm')->name('administrator.login');
    Route::post('/', 'LoginController@validateLogin')->name('administrator.login.submit');
    Route::group(['middleware' => ['auth:administrator']], function () {
        Route::get('/logout', 'LoginController@logout')->name('administrator.logout');
        Route::group(['prefix' => 'dashboard'], function () {

            //page routes
            Route::get('/', 'PageController@dashboard')->name('administrator.dashboard');

            //Available time management
            Route::post('/availableTimeAdd', 'AvailableTimeController@addAvailableTime')->name('administrator.availableTime.add');
            Route::put('/availableTimeUpdate/{id}', 'AvailableTimeController@updateAvailableTime')->name('administrator.availableTime.update');
            Route::get('/availableTimeList', 'AvailableTimeController@viewAllAvailableTimes')->name('administrator.availableTime');
            Route::get('/availableTimeShow/{id}', 'AvailableTimeController@viewAvailableTime')->name('administrator.availableTime.show');
            Route::get('/availableTimeEdit/{id}', 'AvailableTimeController@viewAvailableTime')->name('administrator.availableTime.edit');
            Route::delete('/availableTimeDelete/{id}', 'AvailableTimeController@deleteAvailableTime')->name('administrator.availableTime.delete');

            // Doctor management
            Route::post('/doctorAdd', 'DoctorController@addDoctor')->name('administrator.doctor.add');
            Route::put('/doctorUpdate/{id}', 'DoctorController@updateDoctor')->name('administrator.doctor.update');
            Route::get('/doctorList', 'DoctorController@viewAllDoctors')->name('administrator.doctors');
            Route::get('/doctorShow/{id}', 'DoctorController@viewDoctor')->name('administrator.doctor.show');
            Route::get('/doctorEdit/{id}', 'DoctorController@viewDoctor')->name('administrator.doctor.edit');
            Route::delete('/doctorDelete/{id}', 'DoctorController@deleteDoctor')->name('administrator.doctor.delete');

            // Patient management
            Route::get('/patients', 'PatientController@viewAllPatients')->name('administrator.patients');

            // Appointment management
            Route::get('/appointments', 'AppointmentController@getAppointments')->name('administrator.appointments');
            Route::post('/appointments/{id}/assign-doctor', 'AppointmentController@assignDoctor')->name('administrator.appointments.assignDoctor');

        });
    });
});
