<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'prefix' => 'auth'
], function() {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('create', 'AuthController@create')->name('create');
});


Route::group([
    'middleware' => 'jwt.auth',
    'prefix' => 'employee'
], function($router)  {

    // protected end point to create employee
    Route::post('/', 'EmployeeController@store');
    Route::get('/', 'EmployeeController@index');
    Route::post('compute/paye/{id}', 'EmployeeController@computePayeByEmployeeId');

});

Route::group([
    'middleware' => 'jwt.auth',
    'prefix' => 'scale'
], function($router) {
    Route::post('/', 'ScaleController@store');
    Route::get('/', 'ScaleController@index');


});
Route::get('calculated', 'ScaleController@percentages');
