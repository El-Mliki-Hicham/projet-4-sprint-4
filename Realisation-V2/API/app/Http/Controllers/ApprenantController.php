<?php

namespace App\Http\Controllers;

use App\Models\groupes_apprenant;
use Illuminate\Http\Request;

class ApprenantController extends Controller
{
    function ApprenantsCount($id){
        $Groupes = groupes_apprenant::select("*")->where('groupes.id',$id)
        ->join('groupes', 'groupes_apprenant.Groupe_id', '=', 'groupes.id')
        ->join('apprenant', 'groupes_apprenant.Apprenant_id', '=', 'apprenant.id')
        ->count();
        return $Groupes ;

    }
}
