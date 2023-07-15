<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agriculteur;
use App\Models\Parcelle;
use App\Models\Culture;
use App\Models\SaisonCulture;
use App\Models\Produit;
use App\Models\Variete;
use App\Models\PortefeuilAgriculteur;

use Validator;
use Flash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AgriculteurController extends Controller
{
    //
    public function form(){
        return view('appviews.compte-agriculteur');
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|unique:agriculteurs',
            'password' => 'required|string|min:8',
            'telephone' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('popup', 'error');
        }

        $agriculteur = new Agriculteur();
        $agriculteur->nom = $request->nom;
        $agriculteur->email = $request->email;
        $agriculteur->password = Hash::make($request->password);
        $agriculteur->telephone = $request->telephone;
        $agriculteur->save();

        $portefeuil = new PortefeuilAgriculteur();

        $portefeuil->amount = 0;
        $portefeuil->agriculteur()->associate($agriculteur);

        $portefeuil->save();

        // Flash success message
        Session::flash('success', 'Vous avez creer votre compte avec succès. Connectez vous et completez votre profil!');
        return redirect()->back()->with('popup', 'success');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('agriculteur')->attempt($credentials)) {
            Session::flash('success', 'Connecté avec Succès!');
            return  redirect()->route('agrotech.dashboard');
        } else {
            return back()->withErrors(['email' => 'Invalid email', 'password' => 'Invalid password']);
        }
    }

    public function show($id){
        if($id != null){
            $agriculteur = Agriculteur::find($id);
            return view('appviews.profile-agriculteur', compact('agriculteur'));
      
        }
    }

    /**
     * 
     */
    public function updateform(Request $request , $id){
        if($id != null){
            $agriculteur = Agriculteur::find($id);
            return view('appviews.update-agri', compact('agriculteur'));
      
        }
    }

    public function update(Request $request, $id){

        $agriculteur = Agriculteur::find($id);

        $agriculteur->nom = $request->nom;
        $agriculteur->prenoms = $request->prenoms;
        $agriculteur->sexe = $request->sexe;
        $agriculteur->telephone = $request->telephone;
        $agriculteur->email = $request->email;
        $agriculteur->age = $request->age;
        $agriculteur->ville = $request->ville;
        $agriculteur->village = $request->village;
        $agriculteur->region = $request->region;
        $agriculteur->ferme = $request->ferme;
        $agriculteur->association = $request->association;

        $agriculteur->save();

        return redirect('/agriculteurs/'.$agriculteur->id.'/details');
    }

    public function logout(){
        Auth::guard('agriculteur')->logout();
         return redirect()->route('agrotech.home');
    }

    public function mystore(){
        if(auth('agriculteur')->check()){
            $agriculteur = auth('agriculteur')->user();
            $varietes = $agriculteur->varietes;
            $parcelles = $agriculteur->parcelles;
            $produits = $agriculteur->produits;
            $saisons_current = SaisonCulture::where('année', now()->format('Y'))->get();

            $produitsEnVente = DB::table('produits')
                ->join('vente_produit', 'produits.id', '=', 'vente_produit.produit_id')
                ->join('ventes', 'ventes.id', '=', 'vente_produit.vente_id')
                ->leftJoin('panier_items', 'produits.id', '=', 'panier_items.produit_id')
                ->where('ventes.status', 'encours')
                ->where('produits.agriculteur_id', $agriculteur->id)
                ->select(
                    'produits.*',
                    'vente_produit.created_at as date_mise_en_vente',
                    DB::raw('SUM(panier_items.quantite) as nombre_achats'),
                    DB::raw('SUM(panier_items.quantite * produits.prix) as chiffre_affaires')
                )
                ->groupBy('produits.id', 'vente_produit.created_at', 
                'produits.prix', 'produits.nom', 'produits.image', 
                'produits.poids_base', 
                'produits.agriculteur_id', 'produits.culture_id', 
                'produits.categorie_id', 'produits.created_at', 'produits.updated_at', 
                'produits.description', 'produits.type_vente')
                ->get();

                $produitsNonEnVente = Produit::
                     leftJoin('vente_produit', 'produits.id', '=', 'vente_produit.produit_id')
                    ->leftJoin('ventes', 'ventes.id', '=', 'vente_produit.vente_id')
                    ->leftJoin('panier_items', 'produits.id', '=', 'panier_items.produit_id')
                    ->whereNull('ventes.status')
                    ->orWhere('ventes.status', '<>', 'encours')
                    ->where('produits.agriculteur_id', $agriculteur->id)
                    ->select('produits.*')
                    ->groupBy('produits.id', 'produits.prix', 'produits.nom', 'produits.image', 'produits.poids_base', 'produits.agriculteur_id', 'produits.culture_id', 'produits.categorie_id', 'produits.created_at', 'produits.updated_at', 'produits.description', 'produits.type_vente')
                ->get();

            return view('appviews.agriculteur-store', compact('produitsEnVente', 'produitsNonEnVente'));
        }else{
            return redirect()->back()->with('errors', "Unauthorized");
        }
    }   

}
