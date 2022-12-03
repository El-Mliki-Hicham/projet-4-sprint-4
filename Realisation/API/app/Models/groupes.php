<?php

namespace App\Models;
use App\Models\formateur;
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
}
