<?php

namespace App\Models;
use App\Models\groupes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formateur extends Model
{
    use HasFactory;
    public $timestemps=false;
    protected $table = "formateur";
    protected $fillable = [
        'Nom_formateur',
        "Prenom_formateur",
        "Email_formateur",
        "Phone",
        "Adress",
        "CIN",
        "Image"
    ];

    public function groupes(){
        return $this->hasMany(groupes::class);
       }
}
