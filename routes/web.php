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


//后台第三方github登陆
Route::get('oauth/github', 'SocialController@githubLogin');
Route::get('oauth/github/callback', 'SocialController@githubCallback');

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');


Route::group(['middleware' => 'auth:web', 'namespace' => 'Web\Member', 'prefix' => '/member/'], function () {
    Route::get('/', 'IndexController@index');
    Route::get('/userinfo/', 'IndexController@edit');
    Route::post('/userupdate/', 'IndexController@userupdate');
    
     //供应==  项目-资讯-图片等请参考供应来做就行
    Route::get('/sell/create', 'SellController@create');
    Route::post('/sellstore/', 'SellController@store');
    Route::post('/sell{id}', 'SellController@update');
    Route::get('/sell/{id}/edit', 'SellController@edit');
    Route::get('/sell/{status?}', 'SellController@index');

    Route::get('/password/', 'IndexController@password');
    Route::post('/passwords/', 'IndexController@passwords');
});

//首页
Route::get('/', 'Web\IndexController@index');
//资讯
Route::group(['prefix' => '/news/'], function () {
    //主页
    Route::get('/', 'Web\NewsController@index');
    //详情
    Route::get('/{id}.html', 'Web\NewsController@info');
    //列表
    Route::get('/{path}', 'Web\NewsController@list')->name('news_list');
    Route::get('/{path}/{page}', 'Web\NewsController@list')->name('news_list');
    
});

//know
Route::group(['prefix' => '/know/'], function () {

    Route::get('/{id}.html', 'Web\KnowController@info');
    //主页
    Route::get('/{ptype?}/{page?}', 'Web\KnowController@index')->name('know_list');
    
});

//商城
Route::group(['prefix' => '/mall/'], function () {
    //主页
    Route::get('/', 'Web\MallController@index');
    //详情
    Route::get('/{id}.html', 'Web\MallController@info')->where('id', '[0-9]+');
    //列表
    Route::get('/{sname}', 'Web\MallController@route')->name('mall_list');
    Route::get('/{sname}/p{query}', 'Web\MallController@route')->where('query', '[0-9]+')->name('mall_list');
    Route::get('/{sname}/{query}', 'Web\MallController@route')->where('query', '[A-Za-z]+')->name('mall_list');
    Route::get('/{sname}/{query}/p{page}', 'Web\MallController@route')->where('page', '[0-9]+')->name('mall_list2');
});

//供应
Route::group(['prefix' => '/sell/'], function () {
    //详情
    Route::get('/{id}.html', 'Web\SellController@info')->where('id', '[0-9]+');
    //列表
    Route::get('/{sname?}', 'Web\SellController@route')->name('sell_list');
    Route::get('/{sname}/p{query}', 'Web\SellController@route')->where('query', '[0-9]+')->name('sell_list');
    Route::get('/{sname}/{query}', 'Web\SellController@route')->where('query', '[A-Za-z]+')->name('sell_list');
    Route::get('/{sname}/{query}/p{page}', 'Web\SellController@route')->where('page', '[0-9]+')->name('sell_list2');
});
//图库
Route::group(['prefix' => '/photo/'], function () {
    //主页
    Route::get("/", 'Web\PhotoController@index');
    Route::get('/{id}.html', 'Web\PhotoController@info');
    //列表
    Route::get("/{sname}", 'Web\PhotoController@list')->name('photo_list');
    Route::get("/{sname}/{page}", 'Web\PhotoController@list')->name('photo_list');
});

//项目
Route::group(['prefix' => '/xm/'], function () {
    //主页
    Route::get('/', 'Web\CompanyController@index')->name('xm_index');
    Route::get('/{id}.html', 'Web\CompanyController@info');
    Route::get('/{purl}/{id}.html', 'Web\CompanyController@news_info');
    Route::get('/{jine}', 'Web\CompanyController@index')->name('xm_index_jine');
    Route::get('/{jine}/{page}', 'Web\CompanyController@index')->name('xm_index');
});

//项目分类
Route::get('/{ptype}', 'Web\CompanyController@list')->name('xm_list');
Route::get('/{ptype}/{jine}/{page}', 'Web\CompanyController@list')->name('xm_list_jine');
Route::get('/{ptype}/{jine}', 'Web\CompanyController@list')->name('xm_list_jine');













