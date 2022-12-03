<?php

namespace App\Models;
use App\Models\formateur;
use App\Models\annee_formation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class groupes extends Model
{
    use HasFactory;
    public $timestemps=false;
    protected $table = "groupes";
    protected $fillable = [
        'Nom_groupe',
        "Logo"
    ];

    public function Formateur(){
        return $this->hasOne(formateur::class);
       }
    public function annee_formation(){
        return $this->belongsTo(annee_formation::class);
       }
}
