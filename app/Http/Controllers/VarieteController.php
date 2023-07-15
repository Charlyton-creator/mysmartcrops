<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variete;
use App\Models\Agriculteur;

use Validator;
use Flash;

class VarieteController extends Controller
{
    //

    public function storeview(){
        if(auth('agriculteur')->check()){
            return view('appviews.add-variete');
        }
    }

    public function store(Request $request){
        $rules = [
            'libelle' => 'required|string',
            'code_variete' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);

        if(!$validator->passes()){
            Flash::error($validator->errors());
            return redirect()->back();
        }

        $agriculteur = auth('agriculteur')->user();

        $variete = new Variete();

        $variete->agriculteur()->associate($agriculteur);

        $variete->libelle = $request->libelle;
        $variete->code = $request->code_variete;
        $variete->culture_id = $request->culture_id;

        $variete->save();

        Flash::success("Nouvelle Variete de Culture Enregistrée avec Succès");
        return redirect()->back();
    }
}
