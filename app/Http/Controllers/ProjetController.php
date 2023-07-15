<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projet;
use App\Models\Agriculteur;
use Validator;
use Flash;
use Illuminate\Support\Facades\Storage;

class ProjetController extends Controller
{
    //

    public function submitprojectview(){
        return view('appviews.submit-projetc');
    }

    /**
     * 
     */
    public function store(Request $request){
        if(!auth('agriculteur')->check()){
            return redirect()->back();
        }

        $rules = [
            "designation" => 'required|string',
            "invest_amount" => 'required',
            "description" => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);

        if(!$validator->passes()){
            return redirect()->back();
        }

        $projet = new Projet();

        $agriculteur = auth('agriculteur')->user();

        $projet->agriculteur()->associate($agriculteur);
        $projet->designation = $request->designation;
        $projet->description = $request->description;
        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $originalName = $document->getClientOriginalName();
    
            // Stockage de l'image dans le dossier "public/images"
            $request->document->move(public_path('documents'), $originalName);
        }
        $projet->document_descriptif = $originalName;
        $projet->valeur_investissement_attendu = $request->invest_amount;
        $projet->save();

        Flash::success(['success'=> "Projet Soumis avec Succès notre l'equipe MysmartCrops vérifiera et publiera votre projet"]);

        return redirect()->back();

    }

}
