<?php

namespace App\Models;

// On utilise le "CoreModel" de Lumen qui nous permet d'écrire nos modèles
// plus facilement avec moins de code
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Automatiquement, Eloquent va par défaut chercher dans la table
    // correspondant au nom du modèle en minuscule et mis au pluriel :
    // Modèle Task => Lumen va chercher dans la table 'tasks'
    // Si jamais, ça ne correspond au nom de notre table, on peut toujours
    // préciser à Lumen le nom de la table pour ce modèle en rajoutant
    // un propriété :
    // protected $table = 'mon_nom_de_table';
    // A partir des champs de la table 'tasks', Eloquent va déduire
    // automatiquement les propriétés du modèle Task !

}
