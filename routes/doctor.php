<?php
use Illuminate\Support\Facades\Route;
Route::group([
    'prefix'=>'doctor',
    'namespace'=>'App\Http\Controllers\Doctor',
    'middleware'=>['web']
], function(){
    Route::get('/', 'LoginController@showLoginForm')->name('doctor.login');
    Route::post('/', 'LoginController@validateLogin')->name('doctor.login.submit');
    Route::group(['middleware' => ['auth:doctor']], function () {
        Route::get('/logout', 'LoginController@logout')->name('doctor.logout');
        Route::group(['prefix' => 'dashboard'], function () {

            //page routes
            Route::get('/', 'PageController@dashboard')->name('doctor.dashboard');

            Route::get('/assignments', 'AssignmentController@getAssignments')->name('doctor.assignments');
        });
    });
});
