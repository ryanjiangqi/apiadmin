<?php

use Illuminate\Http\Request;
use App\Http\Middleware\OAuthLogin;

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
Route::put('login', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken')->middleware(OAuthLogin::class);
Route::post('detail', 'UserController@detail')->middleware('auth:api');
Route::post('update', 'UserController@update')->middleware('auth:api');
Route::post('deleted', 'UserController@deleted')->middleware('auth:api');
Route::post('add/save', 'UserController@addSave')->middleware('auth:api');
Route::get('test', 'Client\ClientController@test');


