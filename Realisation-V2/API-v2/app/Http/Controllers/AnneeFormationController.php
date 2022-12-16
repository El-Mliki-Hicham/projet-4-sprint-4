<?php

namespace App\Http\Controllers;

use App\Models\annee_formation;
use Illuminate\Http\Request;

class AnneeFormationController extends Controller
{
   function  index(){
    $Anne = annee_formation::find(1);
    $Anne->Groupe;
    return $Anne;
   }
}
