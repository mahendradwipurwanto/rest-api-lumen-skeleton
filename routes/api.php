<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', 'HealthController@info');
$router->get('/_health', 'HealthController@health');

$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->group(['prefix' => 'product'], function () use ($router) {
        $router->get('/', 'ProductController@index');
        $router->get('/{id}', 'ProductController@show');
        $router->post('/', 'ProductController@store');
        $router->put('/{id}', 'ProductController@update');
        $router->delete('/{id}', 'ProductController@destroy');
    });

    $router->group(['prefix' => 'stock'], function () use ($router) {
        $router->get('/', 'StockController@index');
        $router->get('/{id}', 'StockController@show');
        $router->get('/product/{id}', 'StockController@listByProduct');
        $router->post('/in', 'StockController@storeIn');
        $router->post('/out', 'StockController@storeOut');
    });
});
