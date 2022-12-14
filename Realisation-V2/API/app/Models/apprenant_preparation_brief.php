<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apprenant_preparation_brief extends Model
{
    public $timestemps=false;
    protected $table = "apprenant_preparation_brief";
    protected $fillable = [
        'Date_affectation'
    ];
}
