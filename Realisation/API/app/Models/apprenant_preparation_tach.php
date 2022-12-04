<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apprenant_preparation_tach extends Model
{
    use HasFactory;
    public $timestemps=false;
    protected $table = "apprenant_preparation_tache";
    protected $fillable = [
        'Etat',
        "date_debut",
        "date_fin",
        'Apprenant_id'
    ];
}
