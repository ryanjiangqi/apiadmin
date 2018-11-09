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
//管理员路由
Route::post('user/detail', 'UserController@detail')->middleware('auth:api');
Route::post('user/update', 'UserController@update')->middleware('auth:api');
Route::post('user/deleted', 'UserController@deleted')->middleware('auth:api');
Route::post('user/add/save', 'UserController@addSave')->middleware('auth:api');
//文章路由
Route::post('article/add/save', 'ArticleController@addSave')->middleware('auth:api');
Route::post('article/detail', 'ArticleController@detail')->middleware('auth:api');
Route::post('article/deleted', 'ArticleController@deleted')->middleware('auth:api');
Route::post('article/update', 'ArticleController@update')->middleware('auth:api');



