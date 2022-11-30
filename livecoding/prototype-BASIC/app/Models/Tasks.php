<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable =[
        "Task",
        "Date_debut",
        "Date_fin"
    ];
}
