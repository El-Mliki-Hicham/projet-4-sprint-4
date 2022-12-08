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
        ->orderBy('annee_formation.id','desc')
        ->get();
        return $Groupes ;
    }

    function show($id){
        $Groupes = groupes::select("*")->where('groupes.id',$id)
        ->join('formateur', 'groupes.Formateur_id', '=', 'formateur.id')
        ->join('annee_formation', 'groupes.Annee_formation_id', '=', 'annee_formation.id')
        ->orderBy('annee_formation.id','desc')
        ->get();

        $CountAppenants = groupes_apprenant::select("*")
        ->where([

            ['groupes_apprenant.Groupe_id',$id]
            ])

        ->join('groupes', 'groupes_apprenant.Groupe_id', '=', 'groupes.id')
        ->join('apprenant', 'groupes_apprenant.Apprenant_id', '=', 'apprenant.id')
        ->count();
        return [$Groupes,$CountAppenants] ;
    }

    function OneGroupe($id){
        $Groupes = groupes::select("*","groupes.id as idGroupe")->where('Formateur_id',$id)
        ->join('formateur', 'groupes.Formateur_id', '=', 'formateur.id')
        ->join('annee_formation', 'groupes.Annee_formation_id', '=', 'annee_formation.id')
        ->orderBy('annee_formation.id', 'desc')
        ->first();



        $CountAppenants = groupes_apprenant::select("*")
        ->where([
            ['Formateur_id',$id],
            ['groupes_apprenant.Groupe_id',$Groupes->idGroupe]
            ])

        ->join('groupes', 'groupes_apprenant.Groupe_id', '=', 'groupes.id')
        ->join('apprenant', 'groupes_apprenant.Apprenant_id', '=', 'apprenant.id')
        ->count();

        $GetAppenants = groupes_apprenant::select("*")
        ->where([
            ['Formateur_id',$id],
            ['groupes_apprenant.Groupe_id',$Groupes->idGroupe]
            ])

        ->join('groupes', 'groupes_apprenant.Groupe_id', '=', 'groupes.id')
        ->join('apprenant', 'groupes_apprenant.Apprenant_id', '=', 'apprenant.id')
        ->get();


        return [$Groupes,$CountAppenants,$GetAppenants] ;
    }

         function ApprenantBrief($idF,$idG){
            $ApprenantBrief= apprenant_preparation_tach::select(
                'apprenant.*',
                "groupes_preparation_brief.Groupe_id",
                "preparation_brief.Description as Description_brief","preparation_brief.Nom_du_brief",'preparation_brief.Duree as Duree_biref',
                "preparation_tache.Nom_tache","preparation_tache.Description as Description_tache","preparation_tache.Duree as Duree_tache",
                "apprenant_preparation_tache.*",
                "apprenant_preparation_brief.Date_affectation"
                )
            ->join('apprenant', 'apprenant_preparation_tache.Apprenant_id', '=','apprenant.id')
            ->join('preparation_tache', 'apprenant_preparation_tache.Preparation_tache_id', '=','preparation_tache.id')
            ->join('apprenant_preparation_brief', 'apprenant_preparation_tache.Apprenant_P_Brief_id', '=','apprenant_preparation_brief.id')
            ->join('preparation_brief', 'apprenant_preparation_brief.Preparation_brief_id', '=','preparation_brief.id')
            ->join('groupes_preparation_brief','apprenant_preparation_brief.id','=','groupes_preparation_brief.Apprenant_preparation_brief_id')
            ->where([
                ['Formateur_id',$idF],
                ['groupes_preparation_brief.Groupe_id',$idG]
            ])
            ->get()
            ;
            // dd($ApprenantBrief);
            return $ApprenantBrief;
    }


         function Av_ApprenantTache($idF,$idG,$idA,$idB){



                 //listBrief des apprenant
                 $listBrief= apprenant_preparation_tach::select(

                    "preparation_brief.Nom_du_brief",


                    )
                    ->join('apprenant', 'apprenant_preparation_tache.Apprenant_id', '=','apprenant.id')
                    ->join('preparation_tache', 'apprenant_preparation_tache.Preparation_tache_id', '=','preparation_tache.id')
                    ->join('apprenant_preparation_brief', 'apprenant_preparation_tache.Apprenant_P_Brief_id', '=','apprenant_preparation_brief.id')
                    ->join('preparation_brief', 'apprenant_preparation_brief.Preparation_brief_id', '=','preparation_brief.id')
                    ->join('groupes_preparation_brief','apprenant_preparation_brief.id','=','groupes_preparation_brief.Apprenant_preparation_brief_id')
                    ->where([

                        ['groupes_preparation_brief.Groupe_id',$idG],
                        ['apprenant.id',$idA],


                        ])
                    ->groupBy("Nom_du_brief")
                        ->get();
                        // ->selectRaw('');


                // dd($listBrief);



             //numbre des tache
            $CountToutalTaches= apprenant_preparation_tach::select(

                "preparation_tache.Nom_tache",
                "apprenant_preparation_tache.Etat",

                )
            ->join('apprenant', 'apprenant_preparation_tache.Apprenant_id', '=','apprenant.id')
            ->join('preparation_tache', 'apprenant_preparation_tache.Preparation_tache_id', '=','preparation_tache.id')
            ->join('apprenant_preparation_brief', 'apprenant_preparation_tache.Apprenant_P_Brief_id', '=','apprenant_preparation_brief.id')
            ->join('preparation_brief', 'apprenant_preparation_brief.Preparation_brief_id', '=','preparation_brief.id')
            ->join('groupes_preparation_brief','apprenant_preparation_brief.id','=','groupes_preparation_brief.Apprenant_preparation_brief_id')
            ->where([
                ['Formateur_id',$idF],
                ['groupes_preparation_brief.Groupe_id',$idG],
                ['apprenant.id',$idA],
                ['preparation_brief.id',$idB]
            ])
            ->count()
            ;
            // dd($CountToutalTaches);


                 //numbre des tache terminer
            $ToutalTacheTerminer= apprenant_preparation_tach::select(

                "preparation_tache.Nom_tache",
                "apprenant_preparation_tache.Etat",

                )
                ->join('apprenant', 'apprenant_preparation_tache.Apprenant_id', '=','apprenant.id')
                ->join('preparation_tache', 'apprenant_preparation_tache.Preparation_tache_id', '=','preparation_tache.id')
                ->join('apprenant_preparation_brief', 'apprenant_preparation_tache.Apprenant_P_Brief_id', '=','apprenant_preparation_brief.id')
                ->join('preparation_brief', 'apprenant_preparation_brief.Preparation_brief_id', '=','preparation_brief.id')
                ->join('groupes_preparation_brief','apprenant_preparation_brief.id','=','groupes_preparation_brief.Apprenant_preparation_brief_id')
                ->where([
                    ['Formateur_id',$idF],
                    ['groupes_preparation_brief.Groupe_id',$idG],
                    ['apprenant.id',$idA],
                    ['preparation_brief.id',$idB],
                    ['Etat',"terminer"]
                    ])
                    ->count();
                    // ->selectRaw('');


            // dd($ToutalTacheTerminer);

                 //calculation
                  $result =   100 / $CountToutalTaches ;
                $avancementApp = $result *$ToutalTacheTerminer ;





            // dd($ApprenantBrief);
            return [$avancementApp,$listBrief];
    }



     function AvancementGroups($idG){
      //numbre des tache
      $CountToutalTaches= apprenant_preparation_tach::select(

        "preparation_tache.Nom_tache",
        "apprenant_preparation_tache.Etat",

        )
    ->join('apprenant', 'apprenant_preparation_tache.Apprenant_id', '=','apprenant.id')
    ->join('preparation_tache', 'apprenant_preparation_tache.Preparation_tache_id', '=','preparation_tache.id')
    ->join('apprenant_preparation_brief', 'apprenant_preparation_tache.Apprenant_P_Brief_id', '=','apprenant_preparation_brief.id')
    ->join('preparation_brief', 'apprenant_preparation_brief.Preparation_brief_id', '=','preparation_brief.id')
    ->join('groupes_preparation_brief','apprenant_preparation_brief.id','=','groupes_preparation_brief.Apprenant_preparation_brief_id')
    ->where([

        ['groupes_preparation_brief.Groupe_id',$idG]
    ])
    ->count()
    ;
    // dd($CountToutalTaches);




    $ToutalTacheTerminer= apprenant_preparation_tach::select(

        "preparation_tache.Nom_tache",
        "apprenant_preparation_tache.Etat",

        )
        ->join('apprenant', 'apprenant_preparation_tache.Apprenant_id', '=','apprenant.id')
        ->join('preparation_tache', 'apprenant_preparation_tache.Preparation_tache_id', '=','preparation_tache.id')
        ->join('apprenant_preparation_brief', 'apprenant_preparation_tache.Apprenant_P_Brief_id', '=','apprenant_preparation_brief.id')
        ->join('preparation_brief', 'apprenant_preparation_brief.Preparation_brief_id', '=','preparation_brief.id')
        ->join('groupes_preparation_brief','apprenant_preparation_brief.id','=','groupes_preparation_brief.Apprenant_preparation_brief_id')
        ->where([

            ['groupes_preparation_brief.Groupe_id',$idG],
            ['Etat',"terminer"]
            ])
            ->count();
            // ->selectRaw('');



            //calculation
            $result =   100 / $CountToutalTaches ;
            $avancementApp = $result *$ToutalTacheTerminer ;


            // dd($avancementApp);




            return $avancementApp;
}



}
