<?php
use Illuminate\Support\Facades\Route;
Route::group([
    'prefix'=>'patient',
    'namespace'=>'App\Http\Controllers\Patient',
    'middleware'=>['web']
], function(){
    Route::get('/register', 'PageController@Register')->name('patient.register');
    Route::get('/', 'LoginController@showLoginForm')->name('patient.login');
    Route::post('/', 'LoginController@validateLogin')->name('patient.login.submit');
    Route::group(['middleware' => ['auth:patient']], function () {
        Route::get('/logout', 'LoginController@logout')->name('patient.logout');
        Route::group(['prefix' => 'dashboard'], function () {

            //page routes
            Route::get('/', 'PageController@dashboard')->name('patient.dashboard');

        });
    });
});
