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

Route::get('/user/onLogin', 'Api\PostController@onLogin');

Route::get('/user/register', 'Api\PostController@register');

Route::get('/user/checktoken', 'Api\PostController@checktoken');
//获取文章
Route::get('/article/{id}', 'Api\PostController@articles')->where(['id' => '[1-9]{1}[0-9]*']);

//项目内容
Route::get('/xmcon/{id}', 'Api\PostController@xmCompanys')->where(['id' => '[1-9]{1}[0-9]*']);

//文章列表
Route::get('/news/{path}', 'Api\PostController@listWz')->where('path', '[a-z0-9]+');

//项目列表
Route::get('/comm/{path}/{size?}', 'Api\PostController@listXm')->where('path', '[0-9]+')->where('size', '[0-9]+');






