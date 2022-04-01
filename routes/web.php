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

$router->get('/', function () use ($router) {
    $json_response = [
        'status' => 'success',
        'message' => 'Welcome to the Safe-Courier API. (Laravel Version)',
        'version' => '1.0.0',
        'author' => 'Kallyas Media <kallyasmedia@gmail.com>',
        'url' => 'https://api-v4.safe-courier.ml',
        'other versions' => [
            'Python' => 'http://api-v3.safe-courier.ml',
            'NodeJS' => 'http://api.safe-courier.ml',
        ],
        'github' => [
            'python' => 'https://github.com/kallyas/safe-courier-py',
            'nodejs' => 'https://github.com/kallyas/safe-courier',
            'laravel' => 'https://github.com/kallyas/safe-courier-php',
        ]
    ];
    return response()->json($json_response, 200);
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->post('auth/signup', ['uses' => 'UserController@createUser']);
    $router->post('auth/login', ['uses' => 'UserController@loginUser']);

    $router->delete('users/{id}', ['uses' => 'UserController@deleteUser']);

    $router->put('users/{id}', ['uses' => 'UserController@updateUser']);
});

// user protected routes
$router->group(['prefix' => 'api/v1', 'middleware' => 'auth'], function () use ($router) {
    $router->get('users', ['uses' => 'UserController@showAllUsers']);
    $router->get('users/{id}', ['uses' => 'UserController@showOneUser']);
});

//parcel routes
$router->group(['prefix' => 'api/v1', 'middleware' => 'auth'], function () use ($router) {
    $router->get('parcels', ['uses' => 'ParcelController@showAllParcels']);
    $router->get('parcels/{id}', ['uses' => 'ParcelController@showOneParcel']);
    $router->get('parcels/{id}/parcels', ['uses' => 'ParcelController@showAllParcelsByUser']);

    $router->post('parcels', ['uses' => 'ParcelController@createParcel']);

    $router->delete('parcels/{id}', ['uses' => 'ParcelController@deleteParcel']);

    $router->put('parcels/{id}', ['uses' => 'ParcelController@updateParcel']);
    $router->put('parcels/{id}/status', ['uses' => 'ParcelController@updateParcelStatus']);
    $router->put('parcels/{id}/destination', ['uses' => 'ParcelController@updateParcelDestination']);
    $router->put('parcels/{id}/cancel', ['uses' => 'ParcelController@cancelParcel']);
    $router->put('parcels/{id}/present', ['middleware' => 'role:admin', 'uses' => 'ParcelController@updatePresentLocation']);
});
