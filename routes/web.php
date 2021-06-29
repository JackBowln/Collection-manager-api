<?php
use Illuminate\Support\Facades\Auth;
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
    return $router->app->version();
});
$router->group(['prefix' => 'v1'], function () use ($router) {

    $router->get('books',  ['uses' => 'BookController@showAllBooks']);

    $router->get('books/{id}', ['uses' => 'BookController@showOneBook']);

    $router->post('books/', ['uses' => 'BookController@create']);

    $router->delete('books/{id}', ['uses' => 'BookController@delete']);

    $router->put('books/{id}', ['uses' => 'BookController@update']);

    $router->get('vinyls',  ['uses' => 'VinylController@showAllVinyls']);

    $router->get('vinyls/{id}', ['uses' => 'VinylController@showOneVinyl']);

    $router->post('vinyls', ['uses' => 'VinylController@create']);

    $router->delete('vinyls/{id}', ['uses' => 'VinylController@delete']);

    $router->put('vinyls/{id}', ['uses' => 'VinylController@update']);

    //custom fields endpoints

    $router->get('fields',  ['uses' => 'CustomFieldController@showAllFields']);

    $router->get('fields/{id}', ['uses' => 'CustomFieldController@showOneField']);

    $router->post('fields', ['uses' => 'CustomFieldController@create']);

    $router->delete('fields/{id}', ['uses' => 'CustomFieldController@delete']);

    $router->put('fields/{id}', ['uses' => 'CustomFieldController@update']);

    // Collections

    $router->post('collections', ['uses' => 'CollectionController@create']);

    $router->get('collections', ['uses' => 'CollectionController@index']);

    $router->get('collections/{id}', ['uses' => 'CollectionController@show']);

    // auth

    $router->post('register', 'AuthController@register');

    $router->post('login', 'AuthController@login');

    $router->get('profile', 'UserController@profile');

    // Matches "/v1/users/1
    $router->get('users/{id}', 'UserController@singleUser');

    // Matches "/v1/users
    $router->get('users', 'UserController@allUsers');

    $router->put('profile', 'AuthController@update');

    $router->post('reset-password', 'AuthController@resetPassword');
});
