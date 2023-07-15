<?php

namespace App\Http\Controllers;

use App\Models\Agriculteur;
use App\Models\Variete;
use App\Models\Parcelle;
use App\Models\SaisonCulture;
use App\Models\Plant;
use Validator;
use Flash;

use Illuminate\Http\Request;

class PlantController extends Controller
{
    //
    public function storeview(){
        if(auth('agriculteur')->check()){
            $saisons = SaisonCulture::all();
            return view('appviews.add-plant', compact('saisons'));
        }
    }

    public function store(Request $request){
        $rules = [
            'libelle' => 'required|string',
            'date_semence' => 'required|date',
            'date_1' => 'required|date',
            'engrais' => 'required|string|max:255',
            'variete_id' => 'required|int',
            'saison_id' => 'required|int'
        ];

        $validator = Validator::make($request->all(), $rules);

        if(!$validator->passes()){
            Flash::error($validator->errors());
            return redirect()->back();
        }

        $agriculteur = auth('agriculteur')->user();
        $variete = Variete::find($request->variete_id);
        $saisonculture = SaisonCulture::find($request->saison_id);

        $plant = new Plant();

        $plant->variete()->associate($variete);
        $plant->saisonculture()->associate($saisonculture);
        $plant->agriculteur()->associate($agriculteur);

        $plant->libelle = $request->libelle;
        $plant->engrais_utilises = $request->engrais;
        $plant->date_semence = $request->date_semence;

        $plant->date_entretien_1 = $request->date_1;
        $plant->date_entretien_2 = $request->date_2;
        $plant->date_entretien_3 = $request->date_3;

        $plant->save();

        Flash::success("Plant Enregistrée avec Succès");

        return redirect()->back();
    }
}
