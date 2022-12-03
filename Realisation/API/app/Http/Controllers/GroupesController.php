<?php

namespace App\Http\Controllers;

use App\Models\formateur;
use App\Models\groupes;
use Illuminate\Http\Request;

class GroupesController extends Controller
{
  function  index(){
    // $Groupes = formateur::find(1);
    // $Groupes->groupes;
    // dd($Groupes->groupes);
    // return $Groupes ;

    $Groupes = groupes::select("*")->where('Formateur_id',1)
    ->join('formateur', 'groupes.Formateur_id', '=', 'formateur.id')
    ->join('annee_formation', 'groupes.Annee_formation_id', '=', 'annee_formation.id')
    ->get();
    return $Groupes ;
    }
}
