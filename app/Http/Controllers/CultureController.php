<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Culture;
use App\Models\Agriculteur;
use App\Models\Variete;
use App\Models\Parcelle;
use App\Models\SaisonCulture;

use Validator;
use Flash;

class CultureController extends Controller
{
    //
    public function storeview(){
        if(auth('agriculteur')->check()){
            $saisons = SaisonCulture::all();
            return view('appviews.add-culture', compact('saisons'));
        }
    }

    public function store(Request $request){
        $rules = [
            'nom' => 'required|string',
            'description' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'parcelle_id' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $rules);

        if(!$validator->passes()){
            Flash::error($validator->errors());

            return redirect()->back();
        }

        $agriculteur = auth('agriculteur')->user();
        $parcelle = Parcelle::find($request->parcelle_id);

        $culture = new Culture();
        $culture->parcelle()->associate($parcelle);
        $culture->agriculteur()->associate($agriculteur);

        $culture->nom = $request->nom;
        $culture->description = $request->description;
        $culture->date_debut = $request->date_debut;

        $culture->date_fin = $request->date_fin;
        //code...
        $culture->save();

        Flash::success("Culture Enregistrée avec Succès");

        return redirect()->back();
    }
}
