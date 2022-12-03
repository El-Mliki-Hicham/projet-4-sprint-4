<?php

namespace App\Http\Controllers;

use App\Models\formateur;
use App\Models\groupes;
use Illuminate\Http\Request;

class GroupesController extends Controller
{
  function  index(){
    $Groupes = formateur::find(1);
    $Groupes->groupes;
    return $Groupes ;
   }
}
