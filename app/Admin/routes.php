<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('/ads/categories', \Ads\AdCategoriesController::class);
    $router->resource('/parsers/fermer-ru', \Parsers\FermerRu::class);




    // async
    $router->any('/parsers/fermer',  '\App\Http\Controllers\Parsers\FermerRuCatalog@index');
    $router->any('/parsers/fermer/new-page',  '\App\Http\Controllers\Parsers\FermerRuHelper@getNewItem');
    $router->any('/parsers/fermer/new-pages',  '\App\Http\Controllers\Parsers\FermerRuHelper@getNewItems');
//    $router->any('/parsers/fermer/new-pages-test',  '\App\Http\Controllers\Parsers\FermerRuHelper@testItems');
    $router->any('/parsers/fermer/page',  '\App\Http\Controllers\Parsers\FermerRuItem@index');




});
