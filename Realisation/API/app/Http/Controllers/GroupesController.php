<?php

namespace App\Http\Controllers;

use App\Models\formateur;
use App\Models\groupes;
use App\Models\groupes_apprenant;
use Illuminate\Http\Request;

class GroupesController extends Controller
{
  function  index(){
    // $Groupes = formateur::find(1);
    // $Groupes->groupes;
    // dd($Groupes->groupes);
    // return $Groupes ;


    }

    function showAllGroupes($id){
        $Groupes = groupes::select("*")->where('Formateur_id',$id)
        ->join('formateur', 'groupes.Formateur_id', '=', 'formateur.id')
        ->join('annee_formation', 'groupes.Annee_formation_id', '=', 'annee_formation.id')
        ->get();
        return $Groupes ;
    }

    function show($id){
        $Groupes = groupes::select("*")->where('groupes.id',$id)
        ->join('formateur', 'groupes.Formateur_id', '=', 'formateur.id')
        ->join('annee_formation', 'groupes.Annee_formation_id', '=', 'annee_formation.id')
        ->get();
        return $Groupes ;
    }

    function OneGroupe($id){
        $Groupes = groupes::select("*","groupes.id as idGroupe")->where('Formateur_id',$id)
        ->join('formateur', 'groupes.Formateur_id', '=', 'formateur.id')
        ->join('annee_formation', 'groupes.Annee_formation_id', '=', 'annee_formation.id')
        ->first();



        $CountAppenants = groupes_apprenant::select("*")
        ->where([
            ['Formateur_id',$id],
            ['groupes_apprenant.Groupe_id',$Groupes->idGroupe]
            ])

        ->join('groupes', 'groupes_apprenant.Groupe_id', '=', 'groupes.id')
        ->join('apprenant', 'groupes_apprenant.Apprenant_id', '=', 'apprenant.id')
        ->count();


        return [$Groupes,$CountAppenants] ;
    }

}
