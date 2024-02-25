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

        });
    });
});
