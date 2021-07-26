<?php

namespace App\Http\Controllers;

use App\Models\Category;
// use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * HTTP method : GET
     * URL : '/categories'
     */
    public function list()
    {
        // On veut toutes les catégories présentes en base de données
        // $results = DB::select('SELECT * FROM categories');
        // var_dump($results); exit();
        // Les résultats sont des objets "sans classe", et donc sans Model
        // Ce n'est pas de l'active record, on n'aime pas ça :'-(

        // Donc on va utiliser notre ORM Eloquent qui nous facilite le code :-)
        // https://laravel.com/docs/6.x/eloquent
        $categoriesList = Category::all();
        // dump($categoriesList);

        // https://laravel.com/docs/8.x/responses#strings-arrays
        // Par défaut si on retourne un array, Lumen va le retourner
        // encoder au format JSON
        // return $categoriesList;

        // Mais on peut aussi utiliser https://lumen.laravel.com/docs/8.x/responses#json-responses
        // ce qui pourra être utile si on veut renvoyer des données
        // qui ne sont pas de type array
        // return response()->json($categoriesList);

        // On utilise notre méthode utilitaire pour retourner la liste des catégories
        return $this->sendJsonResponse($categoriesList);
    }

    /**
     * HTTP method : GET
     * URL : '/categories/{id}'
     */
    public function item($categoryId)
    {
        // Attention avec les dump côté API
        // car si je dump, j'envoie des headers classiques text/html
        // hors on voudra renvoyer du JSON (application/json)
        // Les dump doivent être utilisés de façon temporaire
        // et enlever dès qu'on peut pour éviter les problèmes
        // avec le front (code js)
        // dump($categoryId);

        $categoriesList = [
            1 => [
              'id' => 1,
              'name' => 'Chemin vers O\'clock',
              'status' => 1
            ],
            2 => [
              'id' => 2,
              'name' => 'Courses',
              'status' => 1
            ],
            3 => [
              'id' => 3,
              'name' => 'O\'clock',
              'status' => 1
            ],
            4 => [
              'id' => 4,
              'name' => 'Titre Professionnel',
              'status' => 1
            ]
        ];

        if (array_key_exists($categoryId, $categoriesList)) {
        // if (isset($categoriesList[$categoryId])) {
            // On récupère la catégorie à retourner
            $categoryToReturn = $categoriesList[$categoryId];

            // On retourne la réponse au format JSON
            return response()->json($categoryToReturn);
        } else {
            abort(404);
        }
    }
}
