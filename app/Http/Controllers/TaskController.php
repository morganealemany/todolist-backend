<?php

namespace App\Http\Controllers;

// On utilise la classe s'occupant des requêtes HTTP pour Lumen
// ce qui nous permettra d'accéder aux informations envoyées dans
// la requête
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * HTTP method : GET
     * URL : '/tasks'
     */
    public function list()
    {
        // https://laravel.com/docs/6.x/eloquent
        // $tasksList = Task::all();
        // Attention aux dump(), il faut continuer à en faire pour voir
        // ce qu'il y a dans nos variables et avancer étape par étape,
        // par contre un dump() envoie des headers classiques pour un
        // contenu de type text/html, hors, on veut renvoyer un contenu
        // de type application/json
        // ! => il est donc impératif de ne pas avoir de dump() avant
        // ! de retourner le contenu au format JSON

        // Avec l'ajout de load('category'), on fait appel à la méthode
        // category() définie dans la modèle Task et cela nous permet
        // de charger les informations de la catégorie associée à chacune
        // des tâches de notre liste :-)
        $tasksList = Task::all()->load('category');
        // dump($tasksList);

        // On utilise notre méthode utilitaire pour retourner la liste des tâches
        return $this->sendJsonResponse($tasksList);
    }

    /**
     * HTTP method : POST
     * URL : '/tasks'
     */
    // Le type Request avant le paramètre est très important, et même indispensable
    // c'est lui qui permet à Lumen de savoir qu'il doit nous
    // fournir toutes les informations sur la requête HTTP
    public function add(Request $request)
    {
        // L'objet $request est créé par Lumen, c'est un objet complexe
        // mais on n'a pas besoin de voir ces entrailles, il nous faut
        // "juste" explorer la doc pour savoir comment récupérer les informations
        // https://lumen.laravel.com/docs/8.x/requests#accessing-the-request
        // dump($request);

        /* Dans la requête initiale pour ajouter une tâche,
        on envoie les informations suivantes :
            {
                "title": "Mettre en place l'API TodoList",
                "categoryId": 3,
                "completion": 0,
                "status": 1
            }
        */

        // https://lumen.laravel.com/docs/8.x/requests#retrieving-input
        // On doit donc récupérer ces informations envoyées en POST, pour cela :
        // - on s'assure que l'on reçoit au moins le titre et l'id de la
        // catégorie car ces 2 infos sont indispensables pour créer une tâche
        // dans la BDD
        // - completion et satus sont facultatives car ont chacune une valeur par
        // défaut
        // Pour le nom des données fournies en entrée, celui-ci provient
        // de la documentation sur les enpoints de l'API => c'est nous qui
        // les avons choisis

        // if ($request->has('title') && $request->has('categoryId')) {
        // on peut directement tester plusieurs valeurs en fournissant un tableau
        // if ($request->has(['title', 'categoryId'])) {
        // filled est l'équivalent d'un has() + !empty
        if ($request->filled(['title', 'categoryId'])) {

            // on crée un nouvel objet à partir de la classe Task
            $newTask = new Task();

            // on récupère les valeurs fournies dans la requête
            $title = $request->input('title'); // 'title' est le nom du champ envoyé dans le JSON
            $categoryId = $request->input('categoryId');

            // on met à jour les valeurs des propriétés/attributs de notre
            // nouvelle tâche
            $newTask->title = $title;
            $newTask->category_id = $categoryId;

            // Comme il y a déjà des valeurs par défaut dans la BDD,
            // completion et status sont facultatifs, donc change ces
            // propriétés uniquement si elles sont fournies
            if ($request->filled('completion')) {
                $newTask->completion = $request->input('completion');
            }
            if ($request->filled('status')) {
                $newTask->status = $request->input('status');
            }

            // On sauve en base de données l'objet Task
            $newTaskInserted = $newTask->save();

            // Si l'ajout a fonctionné
            if ($newTaskInserted === true) {
                // après le save() l'objet $newTask s'est vu rajouté
                // les attributs created_at, updated_at et id
                // l'id étant nécessaire côté front, il est important
                // de retourner tout l'objet $newTask en retour de la requête
                // alors retourner le code de réponse HTTP 201 "Created"
                // https://restfulapi.net/http-status-201-created/
                // et les données de la tâche au format JSON
                return $this->sendJsonResponse($newTask, Response::HTTP_CREATED);
            }
            // Sinon, il y a eu un souci dans la création de la nouvelle tâche
            else {
                return $this->sendEmptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
                // abort(500);
            }
        }
        // Sinon, c'est que les données requises n'ont pas été fournies
        // ('title' et/ou 'categoryId')
        else {
            // return $this->sendEmptyResponse(400);
            return $this->sendEmptyResponse(Response::HTTP_BAD_REQUEST);
            // ou abort(Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * HTTP method : PUT
     * URL : /tasks/{id}
     */
    public function update(Request $request, int $id)
    {
        // on récupère la tâche à modifier
        $taskToUpdate = Task::find($id);

        // Si la tâche existe ?
        if ($taskToUpdate !== null) {

            // Est-ce que la requête est en PUT ?
            if ($request->isMethod('put')) {

                // On vérifie que les données à mettre à jour sont présentes
                if ($request->filled(['title', 'categoryId', 'completion', 'status'])) {
                    // Mise à jour de l'objet
                    $taskToUpdate->title = $request->input('title');
                    $taskToUpdate->category_id = $request->input('categoryId');
                    $taskToUpdate->completion = $request->input('completion');
                    $taskToUpdate->status = $request->input('status');
                }
                // sinon, il manque des informations => mauvaise requête
                else {
                    return $this->sendEmptyResponse(Response::HTTP_BAD_REQUEST);
                }
            }
            // Sinon, c'est qu'on est en PATCH
            else {
                // On va stocker dans un variable le fait qu'il y ait au moins
                // une des 4 informations fournies
                $oneDataAtLeast = false; // on part du principe qu'il n'y a aucune information fournie

                // Pour chaque information, on regarde si elle est fournie
                // si c'est le cas, on alors on met à jour la tâche pour cette information
                // et on est sûr qu'il y a au moins 1 information mise à jour
                if ($request->filled('title')) {
                    $taskToUpdate->title = $request->input('title');
                    $oneDataAtLeast = true;
                }
                if ($request->filled('categoryId')) {
                    $taskToUpdate->category_id = $request->input('categoryId');
                    $oneDataAtLeast = true;
                }
                if ($request->filled('completion')) {
                    $taskToUpdate->completion = $request->input('completion');
                    $oneDataAtLeast = true;
                }
                if ($request->filled('status')) {
                    $taskToUpdate->status = $request->input('status');
                    $oneDataAtLeast = true;
                }

                // Si on n'a pas au moins 1 information, alors c'est une BAD REQUEST
                if (!$oneDataAtLeast) {
                    return $this->sendEmptyResponse(Response::HTTP_BAD_REQUEST);
                }
            }

            // Si on arrive ici, c'est qu'on n'a pas rencontré d'erreur
            // ni sur le PUT ni sur le PATCH, on peut donc sauver en BDD

            // On sauve dans la BDD
            // et on teste si la modification a fonctionné
            if ($taskToUpdate->save()) {
                // alors retourner un code de réponse HTTP 204 "No Content"
                // https://restfulapi.net/http-methods/#put
                // sans body (pas de JSON ni d'HTML)
                return $this->sendEmptyResponse(Response::HTTP_NO_CONTENT);
            } else {
                return $this->sendEmptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
                // abort(500);
            }
        }
        // Sinon, la tâche n'existe pas => not found 404
        else {
            return $this->sendEmptyResponse(Response::HTTP_NOT_FOUND);
        }
    }
}
