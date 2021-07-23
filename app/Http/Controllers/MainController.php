<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    /**
     * HTTP Méthod : GET
     * url : '/'
     *
     * @return void
     */
    public function home()
    {
        echo "Je suis sur la page d'accueil";
    }
}
