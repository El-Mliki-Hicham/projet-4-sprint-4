<?php

namespace App\Models;
use App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
   protected $fillable=[
    'Name_promotion'
   ];

   public $timestamps=false;

   public function Student(){
    return $this->hasMany(Student::class);
   }
}
