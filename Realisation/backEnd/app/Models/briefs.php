<?php

namespace App\Models;
use App\Models\Tasks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Briefs extends Model
{
    use HasFactory;
    protected $table = "briefs";
    public $timestamps= false;
    protected $fillable = [
        'Nom du brief',
        'Date/heure de livraison',
        'Date/heure de récupération'
    ];

    public function Tasks(){

      return  $this->hasMany(Tasks::class);
    }

    public function Student(){
        return $this->belongsToMany(Student::class);
    }
}
