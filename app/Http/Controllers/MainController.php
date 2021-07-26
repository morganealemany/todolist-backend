<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    /**
     * HTTP method : GET
     * URL : '/'
     */
    public function home()
    {
        return "Je suis sur la page d'accueil";
    }
}
