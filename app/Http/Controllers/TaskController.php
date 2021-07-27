<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class TaskController extends Controller
{
    /**
     * List of all tasks
     *
     * @return
     */
    public function list()
    {

        $tasksList = Task::all();
        // dump($tasksList);

        return $this->sendJsonResponse($tasksList);
    }

    /**
     * Add a new task
     *
     * @param Request $request
     * @return void
     */
    public function add(Request $request)
    {
        // Création d'un nouvel objet Task
        $task = new Task;

        // Remplissage de l'objet avec les informations récupérées en POST
        $task->title = $request->title;
        $task->category_id = $request->categoryId;
        $task->completion = $request->completion;
        $task->status = $request->status;

        // On sauvegarde l'enregistrement
        if ($task->save()) {
            return response()->json($task, Response::HTTP_CREATED);
        }
         else
        {
            return response()->json($task,Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
    /**
     * Return a task from a specific Id
     *
     * @param [int] $taskId
     * @return $task
     */
    public function item($taskId)
    {
        $task = Task::find($taskId);
        return $task;

    }

    /**
     * Update the entry associates to the id
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, int $id)
    {
        // On récupére la tâche que l'on veux modifier grâce à la méthode item
        $currentTask = $this->item($id);

        if (isset($currentTask)) {

            // Si la méthode HTTP est PATCH
            if ($request->getMethod() === 'PATCH')
            {
                // On vérifie qu'au moins une nouvelle information est fournie
                if ($request->has('title') || $request->has('categoryId') || $request->has('completion') || $request->has('status'))
                {
                    if (isset($request->title)) {
                        $currentTask->title = $request->title;
                    }
                    if (isset($request->categoryId)) {
                        $currentTask->category_id = $request->categoryId;
                    }
                    if (isset($request->completion)) {
                        $currentTask->completion = $request->completion;
                    }
                    if (isset($request->status)) {
                        $currentTask->status = $request->status;
                    }
                };
            }
            // Sinon c'est que la méthode HTTP est de type PUT
            else
            {
                // On vérifie que toutes les informations sont bien renseignées
                if ($request->filled(['title', 'categoryId', 'completion', 'status'])) {
                    //
                    $currentTask->title = $request->title;
                    $currentTask->category_id = $request->categoryId;
                    $currentTask->completion = $request->completion;
                    $currentTask->status = $request->status;
                }
                // Sinon c'est qu'il manque des données
                else
                {
                    // On retourne un statut HTTP 400
                    return response()->json($currentTask, Response::HTTP_BAD_REQUEST);
                }
            }
                // On sauvegarde l'enregistrement
                if ($currentTask->save()) {
                    return response()->json($currentTask, Response::HTTP_OK);
                } else {
                    return response()->json($currentTask, Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            } else
            {
                return response()->json($currentTask, Response::HTTP_NOT_FOUND);
            }

    }

}
