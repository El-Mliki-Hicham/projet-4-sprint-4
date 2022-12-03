<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class preparation_tache extends Model
{
    use HasFactory;
    public $timestemps=false;
    protected $table = "preparation_tache";
    protected $fillable = [
        'Nom_tache',
        "Description",
        "Duree",

    ];
}
