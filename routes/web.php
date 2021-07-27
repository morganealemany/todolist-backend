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

// URL : /tasks
// HTTP Method : GET
// Controller : TaskController
// Method : list
$router->get(
    '/tasks',
    [
        'uses' => 'TaskController@list',
        'as'   => 'task-list'
    ]
);

// URL : /tasks
// HTTP Method : POST
// Controller : TaskController
// Method : add
$router->post(
    '/tasks',
    [
        'uses' => 'TaskController@add',
        'as'   => 'task-add'
    ]
);

// URL : /tasks/{id}
// HTTP Method : PUT
// Controller : TaskController
// Method : update
$router->put(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@update',
        'as'   => 'task-update'
    ]
);

// URL : /tasks/{id}
// HTTP Method : PATCH
// Controller : TaskController
// Method : update
$router->patch(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@update',
        'as'   => 'task-patch'
    ]
);
