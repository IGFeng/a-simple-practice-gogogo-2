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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// API - 例 的路由部分
Route::post('/hello', 'ApiController@hello');


Route::post('/two','HomeController@two');

Route::post('/home', 'ApiController@home');

Route::post('/UserAgent', 'ApiController@UserAgent');

Route::post('/Aphorism','ApiController@Aphorism');

Route::group(['prefix' => 'post', 'namespace' => 'Api'], function () {
    Route::post('add', 'PostController@add');
    Route::post('list', 'PostController@list');
    Route::post('delete', 'PostController@delete');
    Route::post('modify', 'PostController@modify');
});

Route::group(['prefix' => 'aphorism', 'namespace' => 'Api'], function () {
    Route::post('add', 'AphorismController@add');
    Route::post('list', 'AphorismController@list');
    Route::post('delete', 'AphorismController@delete');
    Route::post('modify', 'AphorismController@modify');
    Route::post('find','AphorismController@find');
});

Route::group(['prefix' => 'value', 'namespace' => 'Api'], function () {
    Route::post('add', 'ValueController@add');//存储
    Route::post('read', 'ValueController@read');//读取
    Route::post('delete', 'ValueController@delete');
    Route::post('modify', 'ValueController@modify');//修改
    Route::post('connect','ValueController@connect');//合并
});
Route::group(['prefix'=>'remember','namespace'=>'Api'],function(){
    Route::post('find','RememberController@find');
    Route::post('delete','RememberController@delete');
    Route::post('visit','RememberController@visit');
    Route::post('record','RememberController@record');
});
