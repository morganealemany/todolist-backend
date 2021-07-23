<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{
    /**
     * HTTP Méthod : GET
     * url : '/categories'
     *
     * @return void
     */
    public function list()
    {
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

          return $categoriesList;
    }

    /**
     * HTTP Méthod : GET
     * url : '/categories/{id}'
     *
     * @return void
     */
    public function item($categoryId) {
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

            // On récupère la catégorie à retourner
            $categoryToReturn = $categoriesList[$categoryId];

            // On retourne la réponse au format JSON
            return response()->json($categoryToReturn);

          } else {
              abort(404);
          }

    }

}
