<?php

namespace App\Http\Controllers;

use App\Models\Task;
// use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


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

    /**
     * store a new task
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $input = $request->all();

        // Création d'un nouvel objet Task
        $task = new Task;

        // Remplissage de l'objet avec les informations récupérées en POST
        $task->title = $request->title;
        $task->category_id = $request->categoryId;
        $task->completion = $request->completion;
        $task->status = $request->status;

        // On sauvegarde l'enregistrement
        if ($task->save()) {
            echo $task;
            return response()->json($task, Response::HTTP_CREATED);
        }
         else
        {
            return response()->json($task,Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

}
