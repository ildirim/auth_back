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
    return $router->app->version();
});

// user
$router->group(['prefix' => 'user'], function () use ($router) {
    $router->get('/', ['uses' => 'UserController@index']);
    $router->get('/active', ['uses' => 'UserController@activeBranches']);
    $router->get('/{id}', ['uses' => 'UserController@userById']);
    $router->get('/child/{parentId}', ['uses' => 'UserController@useresByParentId']);
    $router->post('/store', ['uses' => 'UserController@store']);
    $router->put('/update/{id}', ['uses' => 'UserController@update']);
    $router->put('/delete/{id}', ['uses' => 'UserController@delete']);
});



// auth user
$router->post('/auth/{id}/id', ['uses' => 'AuthUserController@entranceOrExit']);
$router->post('/auth/report', ['uses' => 'AuthUserController@getAuthUsersByDate']);


// branch
$router->group(['prefix' => 'branch'], function () use ($router) {
    $router->get('/', ['uses' => 'BranchController@index']);
    $router->get('/active', ['uses' => 'BranchController@activeBranches']);
    $router->get('/{id}', ['uses' => 'BranchController@branchById']);
    $router->get('/child/{parentId}', ['uses' => 'BranchController@branchesByParentId']);
    $router->post('/store', ['uses' => 'BranchController@store']);
    $router->put('/update/{id}', ['uses' => 'BranchController@update']);
    $router->put('/delete/{id}', ['uses' => 'BranchController@delete']);
});

// generate qr code
$router->get('/generate-qr-code', ['uses' => 'QrCodeController@generateQrCode']);
