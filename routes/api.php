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
    'middle' => 'jwt.auth',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'user'
], function($router)  {


});
