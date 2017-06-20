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

Route::get('/user', function (Request $request) {
    return ['name'=>'fer'];
})->middleware('jwt.user');
Route::post('authenticate','Api\UserController@authenticate');
Route::post('register','Api\UserController@register');
Route::post('authenticate/driver','Api\DriverController@authenticate');
Route::post('register/driver','Api\DriverController@register');


Route::post('test/driver','Api\DriverController@testd')->middleware('driver');
Route::post('test/user','Api\UserController@testd')->middleware('passenger');
