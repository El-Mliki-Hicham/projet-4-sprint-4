<?php

namespace App\Models;
use App\Models\groupes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class annee_formation extends Model
{
    use HasFactory;

    public $timestemps=false;
    protected $table = "annee_formation";
    protected $fillable = ['Annee_scolaire'];

    public function Groupe(){
        return $this->hasMany(groupes::class);
       }
}
