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
//后台路由
Route::post('user/detail', 'UserController@detail')->middleware('auth:api');
Route::post('user/update', 'UserController@update')->middleware('auth:api');
Route::post('user/deleted', 'UserController@deleted')->middleware('auth:api');
Route::post('user/add/save', 'UserController@addSave')->middleware('auth:api');
Route::post('article/add/save', 'ArticleController@addSave')->middleware('auth:api');
Route::post('article/detail', 'ArticleController@detail')->middleware('auth:api');
Route::post('article/deleted', 'ArticleController@deleted')->middleware('auth:api');
Route::post('article/update', 'ArticleController@update')->middleware('auth:api');
Route::post('about/detail', 'ArticleController@aboutUs')->middleware('auth:api');
Route::post('about/update', 'ArticleController@editAbout')->middleware('auth:api');
//前台路由
Route::post('article/webdetail', 'ArticleController@webDetail');
Route::post('article/indexdetail', 'ArticleController@webIndexDetail');
Route::post('article/bigdetail', 'ArticleController@bigIndexDetail');
Route::post('article/productdetail', 'ArticleController@productDetail');
Route::post('about/webdetail', 'ArticleController@aboutUs');
Route::post('upload/image', 'ArticleController@uploadImage');//->middleware('auth:api')
Route::post('upload/editimage', 'ArticleController@uploadImageEditor');//->middleware('auth:api')
//redis********
