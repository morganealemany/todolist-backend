<?php

namespace App\Http\Controllers;

use App\Models\Task;
// use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function list()
    {

        $tasksList = Task::all();
        // dump($tasksList);

        // https://laravel.com/docs/8.x/responses#strings-arrays
        // Par défaut si on retourne un array, Lumen va le retourner
        // encoder au format JSON
        // return $tasksList;

        // Mais on peut aussi utiliser https://lumen.laravel.com/docs/8.x/responses#json-responses
        // ce qui pourra être utile si on veut renvoyer des données
        // qui ne sont pas de type array
        // return response()->json($tasksList);

        // On utilise notre méthode utilitaire pour retourner la liste des catégories
        return $this->sendJsonResponse($tasksList);
    }


    public function item($taskId)
    {
        // Attention avec les dump côté API
        // car si je dump, j'envoie des headers classiques text/html
        // hors on voudra renvoyer du JSON (application/json)
        // Les dump doivent être utilisés de façon temporaire
        // et enlever dès qu'on peut pour éviter les problèmes
        // avec le front (code js)
        // dump($taskId);

        $tasksList = [
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

        if (array_key_exists($taskId, $tasksList)) {
        // if (isset($tasksList[$TaskId])) {
            // On récupère la catégorie à retourner
            $taskToReturn = $tasksList[$taskId];

            // On retourne la réponse au format JSON
            return response()->json($taskToReturn);
        } else {
            abort(404);
        }
    }
}
