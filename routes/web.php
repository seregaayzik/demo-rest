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

use App\Http\Controllers\RegisterController;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/user/sign-in', 'AuthController@signIn');
    $router->post('/user/register', 'RegisterController@register');

    $router->post('/user/recover-password', 'PasswordRecoveryController@requestPasswordReset');
    $router->patch('/user/recover-password', 'PasswordRecoveryController@resetPassword');
});

$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/user/companies', 'CompanyController@getCompanies');
    $router->post('/user/companies', 'CompanyController@addCompany');
});

