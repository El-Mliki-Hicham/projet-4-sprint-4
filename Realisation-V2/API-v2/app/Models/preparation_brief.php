<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class preparation_brief extends Model
{
    use HasFactory;

    public $timestemps=false;
    protected $table = "preparation_brief";
    protected $fillable = [
        'Nom_du_brief',
        "Description",
        "Duree",

    ];


}
