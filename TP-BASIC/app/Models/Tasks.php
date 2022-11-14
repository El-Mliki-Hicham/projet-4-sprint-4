<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = "tasks";
    public $timestamps= false;
    protected $fillable = [

        'Nom_de_la_tâche',
        'Début_de_la_tâche',
        'Fin_de_la_tâche',
        'briefs_id'
    ];
}
