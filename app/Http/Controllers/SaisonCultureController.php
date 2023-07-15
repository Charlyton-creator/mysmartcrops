<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Culture;
use App\Models\Variete;
use App\Models\Agriculteur;
use App\Models\Parcelle;

class SaisonCultureController extends Controller
{
    //

    public function storeview(){
        return view('appviews.add-saisonculture');
    }

    public function store(Request $request){

    }
}
