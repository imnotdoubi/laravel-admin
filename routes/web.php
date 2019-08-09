<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//第三方github登陆
Route::get('oauth/github', 'SocialController@githubLogin');
Route::get('oauth/github/callback', 'SocialController@githubCallback');

