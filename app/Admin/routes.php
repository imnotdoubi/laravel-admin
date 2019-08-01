<?php

use Illuminate\Routing\Router;

Admin::routes();


Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {


    $router->get('/', 'HomeController@index')->name('admin.home');

    $router->resources([
        // 'posts'                 => PostController::class,
        'articles'              => ArticleController::class,
        'categories'            => CategorieController::class,
        'companys'              => CompanyController::class,
        'news'                  => NewController::class,
        'asks'                  => AskController::class,
        'questions'             => QuestionController::class,
        'malls'                 => MallController::class,
        'countrys'              => AreaController::class,
        'invests'               => InvestmentController::class,

    ]);

    $router->post('articles/release', 'ArticleController@release');
    $router->post('companys/release', 'CompanyController@release');
    $router->post('news/release', 'NewController@release');
    $router->post('asks/release', 'AskController@release');
    $router->post('questions/release', 'QuestionController@release');
    $router->post('malls/release', 'MallController@release');

});
