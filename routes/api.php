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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//留言
Route::get('/iphonexx', 'Api\PostController@iphonexx');

Route::get('/indexfl/{id}', 'Api\PostController@indexFl');

Route::get('/indexdy/{id}', 'Api\PostController@indexHot');
//获取文章
Route::get('/article/{id}', 'Api\PostController@articles')->where(['id' => '[1-9]{1}[0-9]*']);
//文章列表
Route::get('/{path}', 'Api\PostController@listWz')->where('path', '[a-z/_]+');
