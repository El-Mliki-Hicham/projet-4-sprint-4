<?php

namespace App\Http\Controllers;

use App\Models\formateur;
use App\Models\annee_formation;
use Illuminate\Http\Request;

class FormateurController extends Controller
{
    function  index(){
        $Groupes = formateur::All();
        return $Groupes ;
    }

            public function annee_formation(){
                return $this->belongsTo(annee_formation::class);
               }
}
