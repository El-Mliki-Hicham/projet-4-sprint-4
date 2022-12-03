<?php

namespace App\Models;
use App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $table = "tasks";
    public $timestamps= false;
    protected $fillable = [

        'Nom_de_la_tache',
        'Debut_de_la_tache',
        'Fin_de_la_tache',
        'Description',
        'briefs_id'
    ];

    public function briefs(){
        return $this->belongsToMany(Student::class);
    }
}
