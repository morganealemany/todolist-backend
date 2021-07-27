<?php

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

$router->get(
    '/',
    [
        // NomDuContrôleur@NomDeLaMéthode
        'uses' => 'MainController@home',
        // 'identifiant-de-la-route'
        'as'   => 'main-home'
    ]
);
//=================================================
//                  CATEGORY
//=================================================

// URL : /categories
// HTTP Method : GET
// Controller : CategoryController
// Method : list
$router->get(
    '/categories',
    [
        'uses' => 'CategoryController@list',
        'as'   => 'category-list'
    ]
);

// URL : /categories/[id] où [id] est une portion dynamique de l'URL
// HTTP Method : GET
// Controller : CategoryController
// Method : item
$router->get(
    '/categories/{id}',
    [
        'uses' => 'CategoryController@item',
        'as'   => 'category-item'
    ]
);

//=================================================
//                  TASK
//=================================================


$router->get(
    '/tasks',
    [
        'uses' => 'TaskController@list',
        'as'   => 'task-list'
    ]
);

$router->post(
    '/tasks',
    [
        'uses' => 'TaskController@add',
        'as'   => 'task-add'
    ]
);

$router->get(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@item',
        'as'   => 'task-item'
    ]
);

$router->put(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@update',
        'as'   => 'task-update'
    ]
);

$router->patch(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@update',
        'as'   => 'task-update'
    ]
);
