<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apprenant extends Model
{
    use HasFactory;
    public $timestemps=false;
    protected $table = "apprenant";
    protected $fillable = [
        'Nom',
        "Prenom",
        "Email",
        "Phone",
        "Adress",
        "CIN",
        'Date_naissance',
        "Image"
    ];
}
