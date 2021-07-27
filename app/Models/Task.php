<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // En écrivant cette méthode, cela permet de définir une relation
    // entre les modèles Category et Task
    //
    // Graĉe à cette relation, on peut aller chercher les informations de la
    // catégorie liée à la tâche
    //
    // Et comme une tâche est liée à une seule catégorie :
    //   => on a donc une relation de type : One to Many (inverse)
    //
    // https://laravel.com/docs/6.x/eloquent-relationships#one-to-many-inverse
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
