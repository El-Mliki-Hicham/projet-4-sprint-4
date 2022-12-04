<?php

namespace App\Http\Controllers;

use App\Models\apprenant_preparation_brief;
use App\Models\apprenant_preparation_tach;
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

         function ApprenantBrief($id){
            $ApprenantBrief= apprenant_preparation_tach::select('apprenant.*',"apprenant.id as idGroup","Etat",'preparation_tache.*',"apprenant_preparation_brief.*","preparation_brief.*")
            ->join('apprenant', 'apprenant_preparation_tache.Apprenant_id', '=','apprenant.id')
            ->join('preparation_tache', 'apprenant_preparation_tache.Preparation_tache_id', '=','preparation_tache.id')
            ->join('apprenant_preparation_brief', 'apprenant_preparation_tache.Apprenant_P_Brief_id', '=','apprenant_preparation_brief.id')
            ->join('preparation_brief', 'apprenant_preparation_brief.Preparation_brief_id', '=','preparation_brief.id')
            ->where('Formateur_id',$id)
            ->get()
            ;
            dd($ApprenantBrief);
            return $ApprenantBrief;
    }

}
