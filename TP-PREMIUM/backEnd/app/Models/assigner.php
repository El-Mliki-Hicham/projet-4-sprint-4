<?php

namespace App\Models;
use App\Models\Briefs;
use App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assigner extends Model
{
    use HasFactory;


    public $table= "briefs_student";
    public $timestamps= false;

    function brief(){
        // return $this->whereBelongsTo(Briefs::class);
        return $this->hasManyThrough(Briefs::class, Student::class);
    }
}
