<?php

namespace App\Http\Controllers;

use App\Models\groupes;
use App\Models\formateur;
use Illuminate\Http\Request;
use App\Models\groupes_apprenant;
use Illuminate\Support\Facades\DB;
use App\Models\apprenant_preparation_tach;
use App\Models\apprenant_preparation_brief;

class GroupesController extends Controller
{


    function showAllGroupes($id){
        $Groupes = groupes::select("*")->where('Formateur_id',$id)
        ->join('formateur', 'groupes.Formateur_id', '=', 'formateur.id')
        ->join('annee_formation', 'groupes.Annee_formation_id', '=', 'annee_formation.id')
        ->orderBy('annee_formation.id','desc')
        ->get();
        return $Groupes ;
    }


//anne scolaire
    function show($id){
        $Groupes = groupes::select("*")->where('groupes.id',$id)
        ->join('formateur', 'groupes.Formateur_id', '=', 'formateur.id')
        ->join('annee_formation', 'groupes.Annee_formation_id', '=', 'annee_formation.id')
        ->orderBy('annee_formation.Annee_scolaire','desc')
        ->get();



        $CountAppenants = groupes_apprenant::select("*")
        ->where([

            ['groupes_apprenant.Groupe_id',$id]
            ])

        ->join('groupes', 'groupes_apprenant.Groupe_id', '=', 'groupes.id')
        ->join('apprenant', 'groupes_apprenant.Apprenant_id', '=', 'apprenant.id')
        ->count();


        // calcul avancement du brief
        $listBrief= apprenant_preparation_tach::select(
            "preparation_brief.Nom_du_brief",'preparation_brief.id as id' ,
            DB::raw(" 100 / count('apprenant_preparation_tache.Etat')   * count(CASE Etat WHEN 'terminer' THEN 1 ELSE NULL END) as  Percentage"),
            )
            ->join('apprenant', 'apprenant_preparation_tache.Apprenant_id', '=','apprenant.id')
            ->join('preparation_tache', 'apprenant_preparation_tache.Preparation_tache_id', '=','preparation_tache.id')
            ->join('apprenant_preparation_brief', 'apprenant_preparation_tache.Apprenant_P_Brief_id', '=','apprenant_preparation_brief.id')
            ->join('preparation_brief', 'apprenant_preparation_brief.Preparation_brief_id', '=','preparation_brief.id')
            ->join('groupes_preparation_brief','apprenant_preparation_brief.id','=','groupes_preparation_brief.Apprenant_preparation_brief_id')
            ->where([
                ['groupes_preparation_brief.Groupe_id',$id],
                ])
            ->groupBy("Nom_du_brief")
            ->groupBy("preparation_brief.id")
                ->get();
                    return [$Groupes,$CountAppenants,$listBrief] ;
            }



    //last groupe
    function OneGroupe($id){
        $Groupes = groupes::select("*","groupes.id as idGroupe")->where('Formateur_id',$id)
        ->join('formateur', 'groupes.Formateur_id', '=', 'formateur.id')
        ->join('annee_formation', 'groupes.Annee_formation_id', '=', 'annee_formation.id')
        ->orderBy('annee_formation.Annee_scolaire','desc')
        ->first();
        $IdBrief= apprenant_preparation_tach::select(
            "preparation_brief.Nom_du_brief",'preparation_brief.id as id' ,
            )
            ->join('apprenant', 'apprenant_preparation_tache.Apprenant_id', '=','apprenant.id')
            ->join('preparation_tache', 'apprenant_preparation_tache.Preparation_tache_id', '=','preparation_tache.id')
            ->join('apprenant_preparation_brief', 'apprenant_preparation_tache.Apprenant_P_Brief_id', '=','apprenant_preparation_brief.id')
            ->join('preparation_brief', 'apprenant_preparation_brief.Preparation_brief_id', '=','preparation_brief.id')
            ->join('groupes_preparation_brief','apprenant_preparation_brief.id','=','groupes_preparation_brief.Apprenant_preparation_brief_id')
            ->where([
                ['groupes_preparation_brief.Groupe_id',$Groupes->idGroupe],
                ])
            ->groupBy("Nom_du_brief")
            ->groupBy("preparation_brief.id")
            ->orderBy('preparation_brief.id','desc')
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

   $CountToutalTaches= apprenant_preparation_tach::select(

    "preparation_tache.Nom_tache",
    "apprenant_preparation_tache.Etat",

    )
->join('apprenant', 'apprenant_preparation_tache.Apprenant_id', '=','apprenant.id')
->join('preparation_tache','apprenant_preparation_tache.Preparation_tache_id', '=','preparation_tache.id')
->join('apprenant_preparation_brief', 'apprenant_preparation_tache.Apprenant_P_Brief_id', '=','apprenant_preparation_brief.id')
->join('preparation_brief', 'apprenant_preparation_brief.Preparation_brief_id', '=','preparation_brief.id')
->join('groupes_preparation_brief','apprenant_preparation_brief.id','=','groupes_preparation_brief.Apprenant_preparation_brief_id')
->where([

    ['groupes_preparation_brief.Groupe_id',$Groupes->idGroupe]
])
->count();



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

        ['groupes_preparation_brief.Groupe_id',$Groupes->idGroupe],
        ['Etat',"terminer"]
        ])
        ->count();
        if($CountToutalTaches == 0){
            $avancementApp= 0;
        }else{
            $result =   100 / $CountToutalTaches ;
            $avancementApp = $result *$ToutalTacheTerminer ;
        }

        //              //listBrief des apprenant
                 $listBrief= apprenant_preparation_tach::select(

                    "preparation_brief.Nom_du_brief",'preparation_brief.id as id' ,
                    DB::raw(" 100 / count('apprenant_preparation_tache.Etat')   * count(CASE Etat WHEN 'terminer' THEN 1 ELSE NULL END) as Percentage"),
                    )
                    ->join('apprenant', 'apprenant_preparation_tache.Apprenant_id', '=','apprenant.id')
                    ->join('preparation_tache', 'apprenant_preparation_tache.Preparation_tache_id', '=','preparation_tache.id')
                    ->join('apprenant_preparation_brief', 'apprenant_preparation_tache.Apprenant_P_Brief_id', '=','apprenant_preparation_brief.id')
                    ->join('preparation_brief', 'apprenant_preparation_brief.Preparation_brief_id', '=','preparation_brief.id')
                    ->join('groupes_preparation_brief','apprenant_preparation_brief.id','=','groupes_preparation_brief.Apprenant_preparation_brief_id')
                    ->where([

                        ['groupes_preparation_brief.Groupe_id',$Groupes->idGroupe],


                        ])
                    ->groupBy("Nom_du_brief")
                    ->groupBy("preparation_brief.id")
                    ->orderBy('preparation_brief.id','desc')
                    // ->selectRaw('preparation_brief.id as id')
                        ->get();
                        // dd($listBrief);
                 $FirstBrief= apprenant_preparation_tach::select(
                    "apprenant.Nom",
                    "preparation_brief.Nom_du_brief",'preparation_brief.id as id' ,
                    DB::raw(" 100 / count('apprenant_preparation_tache.Etat')   * count(CASE Etat WHEN 'terminer' THEN 1 ELSE NULL END) as Percentage"),
                    )
                    ->join('apprenant', 'apprenant_preparation_tache.Apprenant_id', '=','apprenant.id')
                    ->join('preparation_tache', 'apprenant_preparation_tache.Preparation_tache_id', '=','preparation_tache.id')
                    ->join('apprenant_preparation_brief', 'apprenant_preparation_tache.Apprenant_P_Brief_id', '=','apprenant_preparation_brief.id')
                    ->join('preparation_brief', 'apprenant_preparation_brief.Preparation_brief_id', '=','preparation_brief.id')
                    ->join('groupes_preparation_brief','apprenant_preparation_brief.id','=','groupes_preparation_brief.Apprenant_preparation_brief_id')
                    ->where([

                        ['groupes_preparation_brief.Groupe_id',$Groupes->idGroupe],
                        ['preparation_brief.id',$IdBrief->id],


                        ])
                    ->groupBy("Nom_du_brief")
                    ->groupBy("Nom")
                    ->groupBy("preparation_brief.id")
                    ->orderBy('preparation_brief.id','desc')
                    // ->selectRaw('preparation_brief.id as id')
                        ->get();
                        // dd($FirstBrief);

        return [$Groupes,$CountAppenants,$GetAppenants,$avancementApp,$listBrief,$FirstBrief];
    }
        function ListApprenant($id){

                $ListApprentant = groupes_apprenant::select("apprenant.*",'groupes.*')
                ->join('groupes', 'groupes_apprenant.Groupe_id', '=','groupes.id')
                ->join('apprenant', 'groupes_apprenant.Apprenant_id', '=','apprenant.id')
                ->join('annee_formation', 'groupes.Annee_formation_id', '=', 'annee_formation.id')

                ->orderBy('annee_formation.Annee_scolaire','desc')
                ->where([

                    ["Groupe_id",$id]
                ])
                 ->get();
                    // dd($ListApprentant->toArray());



                return response()->json([
                    'items' => $ListApprentant
                ]);
            }



         function Av_ApprenantTache($idG,$idB){





    //                     ])
    //                 ->groupBy("Nom_du_brief")
    //                     ->get();
    //                     // ->selectRaw('');


    //             // dd($listBrief);



    //          //numbre des tache
            $BriefAV= apprenant_preparation_tach::select(

                "apprenant.Nom",
                // "apprenant_preparation_tache.Etat",
                // DB::raw("count('apprenant_preparation_tache.Etat')"),
                // DB::raw("count(CASE Etat WHEN 'terminer' THEN 1 ELSE NULL END)"),
                DB::raw(" 100 / count('apprenant_preparation_tache.Etat')   * count(CASE Etat WHEN 'terminer' THEN 1 ELSE NULL END) as Percentage"),

                )
            ->join('apprenant', 'apprenant_preparation_tache.Apprenant_id', '=','apprenant.id')
            ->join('preparation_tache', 'apprenant_preparation_tache.Preparation_tache_id', '=','preparation_tache.id')
            ->join('apprenant_preparation_brief', 'apprenant_preparation_tache.Apprenant_P_Brief_id', '=','apprenant_preparation_brief.id')
            ->join('preparation_brief', 'apprenant_preparation_brief.Preparation_brief_id', '=','preparation_brief.id')
            ->join('groupes_preparation_brief','apprenant_preparation_brief.id','=','groupes_preparation_brief.Apprenant_preparation_brief_id')
            ->where([

                ['groupes_preparation_brief.Groupe_id',$idG],

                ['preparation_brief.id',$idB]
            ])
            ->groupBy('Nom')
            ->get()
            ;

            // dd($CountToutalTaches);


    //              //numbre des tache terminer
    //         $ToutalTacheTerminer= apprenant_preparation_tach::select(

    //             "preparation_tache.Nom_tache",
    //             "apprenant_preparation_tache.Etat",

    //             )
    //             ->join('apprenant', 'apprenant_preparation_tache.Apprenant_id', '=','apprenant.id')
    //             ->join('preparation_tache', 'apprenant_preparation_tache.Preparation_tache_id', '=','preparation_tache.id')
    //             ->join('apprenant_preparation_brief', 'apprenant_preparation_tache.Apprenant_P_Brief_id', '=','apprenant_preparation_brief.id')
    //             ->join('preparation_brief', 'apprenant_preparation_brief.Preparation_brief_id', '=','preparation_brief.id')
    //             ->join('groupes_preparation_brief','apprenant_preparation_brief.id','=','groupes_preparation_brief.Apprenant_preparation_brief_id')
    //             ->where([
    //                 ['Formateur_id',$idF],
    //                 ['groupes_preparation_brief.Groupe_id',$idG],
    //                 ['apprenant.id',$idA],
    //                 ['preparation_brief.id',$idB],
    //                 ['Etat',"terminer"]
    //                 ])
    //                 ->count();
    //                 // ->selectRaw('');


    //         // dd($ToutalTacheTerminer);

    //              //calculation
    //               $result =   100 / $CountToutalTaches ;
    //             $avancementApp = $result *$ToutalTacheTerminer ;





    //         // dd($ApprenantBrief);
            return [$BriefAV];
    }

//
//
//
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
