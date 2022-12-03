<?php

namespace App\Http\Controllers;

use App\Models\formateur;
use Illuminate\Http\Request;

class FormateurController extends Controller
{
    function  index(){
        $Groupes = formateur::All();
        return $Groupes ;
       }
}
