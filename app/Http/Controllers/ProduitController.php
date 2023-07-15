<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Agriculteur;
use App\Models\Culture;
use App\Models\Vente;
use Illuminate\Support\Facades\Storage;

use Flash;
use Validator;

class ProduitController extends Controller
{
    //

    public function index(){


        $cereales = Produit::whereHas('ventes', function ($query) {
            $query->where('status', 'encours');
        })->whereHas('categorie', function ($query) {
            $query->where('libelle', 'Cereales');
        })->get();        
        $tubercules = Produit::whereHas('ventes', function ($query) {
            $query->where('status', 'encours');
        })->whereHas('categorie', function ($query) {
            $query->where('libelle', 'Tubercules');
        })->get();
        
        $fruits = Produit::where(function ($query) {
            $query->whereHas('ventes', function ($query) {
                $query->where('status', 'encours');
            })->whereHas('categorie', function ($query) {
                $query->where('libelle', 'Legumineuses');
            });
        })->orWhere(function ($query) {
            $query->whereHas('ventes', function ($query) {
                $query->where('status', 'encours');
            })->whereHas('categorie', function ($query) {
                $query->where('libelle', 'Fruits');
            });
        })->get();
        
        $oleagineux = Produit::whereHas('ventes', function ($query) {
            $query->where('status', 'encours');
        })->whereHas('categorie', function ($query) {
            $query->where('libelle', 'Oleagineux');
        })->get();
        

        $trendings = $this->produitsAleatoires();
        $duree = 0;
        $vente = Vente::where('status', 'encours')->first();
        if($vente){
            $duree = $vente->duree;
        }

        return view('appviews.espace-marche',compact('cereales', 'tubercules','fruits','oleagineux','trendings', 'duree'));
    }

    private function produitsAleatoires()
    {
        // Récupérer deux produits de chaque catégorie de manière aléatoire
        $fruits = Produit::whereHas('ventes', function ($query) {
            $query->where('status', 'encours');
        })->whereHas('categorie', function ($query) {
            $query->where('libelle', 'Fruits');
        })->inRandomOrder()->limit(2)->get();
        
        $legumes = Produit::whereHas('ventes', function ($query) {
            $query->where('status', 'encours');
        })->whereHas('categorie', function ($query) {
            $query->where('libelle', 'Legumineuses');
        })->inRandomOrder()->limit(2)->get();
        
        $tubercules = Produit::whereHas('ventes', function ($query) {
            $query->where('status', 'encours');
        })->whereHas('categorie', function ($query) {
            $query->where('libelle', 'Tubercules');
        })->inRandomOrder()->limit(2)->get();        

        // Fusionner les collections de produits en une seule collection
        $produits = $fruits->concat($legumes)->concat($tubercules);

        // Retourner la collection de produits aléatoires
        return $produits;
    }

    public function show($id){
        $produit = Produit::find($id);
        if(!empty($produit)){
            return view('appviews.product-detail', compact('produit'));
        }else{
            
        }
    }

    public function viewaddproduct(){
        if(auth('agriculteur')->check()){
            $categories = Categorie::all();
            return view('appviews.add-product', compact('categories'));
        }   
    }

    public function store(Request $request){
        if(auth('agriculteur')->check()){
            $rules = [
                'nom' => 'required',
                'prix' => 'required',
                'quantite' => 'required',
                'culture_id' => 'required',
                'categorie_id' => 'required',
                'selectedCheckbox' => 'required|in:Kilo,Unité,Tas de 3,Bol'
            ];

            $validator = Validator::make($request->all(), $rules);

            if(!$validator->passes()){
                Flash::error($validator->errors());
                return redirect()->back();
            }

            $categorie = Categorie::find($request->categorie_id);
            $agriculteur = Agriculteur::find(auth('agriculteur')->user()->id);
            $culture = Culture::find($request->culture_id);

            $produit = new Produit();

            $produit->categorie()->associate($categorie);
            $produit->culture()->associate($culture);
            $produit->agriculteur()->associate($agriculteur);
            $produit->nom = $request->nom;
            $produit->prix = $request->prix;
            $produit->poids_base = $request->quantite;
            $produit->description = $request->description;
            $produit->type_vente = $request->input('selectedCheckbox');

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $originalName = $image->getClientOriginalName();
        
                // Stockage de l'image dans le dossier "public/images"
                $image->storeAs('public/images', $originalName);
            }
            $produit->image = $originalName;

            $produit->save();

            if($request->has('mise_en_vente')){
               $vente = Vente::where("status", 'encours')->first();

               $vente->produits()->attach($produit->id);

               $vente->save();
            }
            Flash::success('Produit Ajouté avec Succès');
            return redirect()->back();
        }
    }
    /**
     * 
     */
    public function setProductVenteStatus(Request $request, $produitId){
        $vente = Vente::where("status", 'encours')->first();
        $vente->produits()->attach($produitId);
        $vente->save();
        return response()->json(['success' => true]);
    }
}
