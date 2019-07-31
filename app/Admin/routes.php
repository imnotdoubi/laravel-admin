<?php

use Illuminate\Routing\Router;

Admin::routes();


Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {


    $router->get('/', 'HomeController@index')->name('admin.home');

	$router->post('articles/release', 'ArticleController@release');
    $router->post('companys/release', 'CompanyController@release');
    $router->post('news/release', 'NewController@release');

    $router->resources([
        // 'posts'                 => PostController::class,
        'articles'              => ArticleController::class,
        'categories'            => CategorieController::class,
        'companys'              => CompanyController::class,
        'news'                  => NewController::class,
        'countrys'              => AreaController::class,
        'invests'               => InvestmentController::class,

    ]);

});
