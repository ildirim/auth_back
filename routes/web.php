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
    $router->get('/', ['uses' => 'UserController@users']);
    $router->get('/active', ['uses' => 'UserController@activeUsers']);
    $router->get('/{id}', ['uses' => 'UserController@userById']);
    $router->get('/child/{parentId}', ['uses' => 'UserController@useresByParentId']);
    $router->post('/check', ['uses' => 'UserController@check']);
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
    $router->get('/children', ['uses' => 'BranchController@childrenBranches']);
    $router->get('/{id}', ['uses' => 'BranchController@branchById']);
    $router->get('/child/{parentId}', ['uses' => 'BranchController@branchesByParentId']);
    $router->post('/store', ['uses' => 'BranchController@store']);
    $router->put('/update/{id}', ['uses' => 'BranchController@update']);
    $router->put('/delete/{id}', ['uses' => 'BranchController@delete']);
});


// position
$router->group(['prefix' => 'position'], function () use ($router) {
    $router->get('/', ['uses' => 'PositionController@positions']);
    $router->get('/active', ['uses' => 'PositionController@activePositions']);
    $router->get('/{id}', ['uses' => 'PositionController@positionById']);
    $router->post('/store', ['uses' => 'PositionController@store']);
    $router->put('/update/{id}', ['uses' => 'PositionController@update']);
    $router->put('/delete/{id}', ['uses' => 'PositionController@delete']);
});

// work permits
$router->group(['prefix' => 'work-permit'], function () use ($router) {
    $router->get('/', ['uses' => 'WorkPermitController@workPermits']);
    $router->get('/{userId}/pending', ['uses' => 'WorkPermitController@pendingWorkPermitsByUserId']);
    $router->get('/{userId}/user-id', ['uses' => 'WorkPermitController@workPermitsByUserId']);
    $router->post('/report/user-id2', ['uses' => 'WorkPermitController@workPermitsByUserId2']);
    $router->get('/{id}/id', ['uses' => 'WorkPermitController@workPermitById']);
    $router->post('/store', ['uses' => 'WorkPermitController@store']);
    $router->put('/approve/{id}', ['uses' => 'WorkPermitController@approve']);
    $router->put('/reject/{id}', ['uses' => 'WorkPermitController@reject']);
    $router->put('/update/{id}', ['uses' => 'WorkPermitController@update']);
    $router->put('/delete/{id}', ['uses' => 'WorkPermitController@delete']);
});

// generate qr code
$router->get('/generate-qr-code', ['uses' => 'QrCodeController@generateQrCode']);
