<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parcelle;
use App\Models\Agriculteur;

use Validator;
use Flash;

class ParcelleController extends Controller
{
    //
    public function storeview(){
        if(auth('agriculteur')->check()){
            return view('appviews.add-parcelle');
        }
    }

    public function store(Request $request){
        $rules = [
            'designation' => 'required|string',
            'lieu' => 'nullable|string',
            'etendu' => 'nullable|string'
        ];

        $validator = Validator::make($request->all(), $rules);

        if(!$validator->passes()){
            Flash::error("Erreur de validation des données veuillez verifier les données envoyés");
            return redirect()->back();
        }

        $agriculteur = auth('agriculteur')->user();
        $parcelle = new Parcelle();

        $parcelle->agriculteur()->associate($agriculteur);

        $parcelle->designation = $request->designation;
        $parcelle->lieu = $request->lieu;
        $parcelle->etendu = $request->etendu;

        $parcelle->save();

        Flash::success("Nouveau parcelle définie avec Succès");

        return redirect()->back();
    }
}
