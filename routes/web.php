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
