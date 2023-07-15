<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use App\Models\Conseil;
use App\Models\Offre;
use App\Models\Projet;
use App\Models\Produit;
use App\Models\PanierItem;
use App\Models\Panier;
use App\Models\Agriculteur;
use App\Models\Particulier;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function dashboard(){
        if(!auth('agriculteur')->check()){
            return view('appviews.agrotech-dashboard');
        }else{
            $agriculteurId = auth('agriculteur')->user()->id;
            $data = DB::table('saison_cultures')
                ->join('plants', 'plants.saison_culture_id', '=', 'saison_cultures.id')
                ->join('varietes', 'varietes.id', '=', 'plants.variete_id')
                ->join('agriculteurs', 'agriculteurs.id', '=', 'plants.agriculteur_id')
                ->select('saison_cultures.mois_debut AS saison', 'varietes.libelle AS variete', DB::raw('COUNT(plants.id) AS nombreCultures'))
                ->where('agriculteurs.id', $agriculteurId)
                ->groupBy('saison_cultures.mois_debut', 'varietes.libelle')
                ->get();

            // Conversion des résultats en tableau

            $data2 = DB::table('saison_cultures')
                ->leftJoin('recoltes', function ($join) {
                    $join->on('recoltes.saison_culture_id', '=', 'saison_cultures.id')
                        ->where('recoltes.agriculteur_id', '=', auth('agriculteur')->user()->id);
                })
                ->select('saison_cultures.mois_debut AS saison', 'recoltes.poids_engendre AS poids')
                ->orderBy('saison_cultures.id')
                ->get();

            
            // Créer les tableaux pour les saisons et les poids
            $saisons = [];
            $poids = [];

            foreach ($data2 as $item) {
                $saisons[] = $item->saison;
                $poids[] = (float) $item->poids;
            }

            // Créer le tableau final dans le format attendu
            $result = [
                'saisons' => $saisons,
                'poids' => $poids,
            ];

            $resultats = DB::table('saisons')
                    ->leftJoin('ventes', 'saisons.id', '=', 'ventes.saison_id')
                    ->leftJoin('vente_produit', 'ventes.id', '=', 'vente_produit.vente_id')
                    ->leftJoin('produits', 'produits.id', '=', 'vente_produit.produit_id')
                    ->leftJoin('panier_items', 'produits.id', '=', 'panier_items.produit_id')
                    ->where('produits.agriculteur_id', $agriculteurId)
                    ->where('ventes.status', 'encours')
                    ->select(
                        'saisons.libelle as saison',
                        DB::raw('SUM(panier_items.quantite * produits.prix) as chiffre_affaires')
                    )
                    ->groupBy('saisons.libelle')
                    ->get();
                $tableauSaisons = [];
                $tableauChiffreAffaires = [];

                $tableauSaisons = [];
                $tableauChiffreAffaires = [];
                
                foreach ($resultats as $resultat) {
                    $tableauSaisons[] = $resultat->saison;
                    $tableauChiffreAffaires[] = $resultat->chiffre_affaires;
                }
                $panierItems = PanierItem::whereHas('produit', function ($query) use ($agriculteurId) {
                    $query->where('agriculteur_id', $agriculteurId);
                })
                ->whereNotNull('commande_id')
                ->get();
                // Construire le tableau d'éléments
                $produitsCommandes = $panierItems->map(function ($panierItem) {
                    return (object) [
                        'utilisateur' => Particulier::find(Panier::find($panierItem->panier_id)->particulier_id)->noms,
                        'date_commande' => $panierItem->commande->created_at, // Assurez-vous d'avoir la relation "commande" définie dans le modèle PanierItem
                        'statut_commande' => $panierItem->commande->etat
                    ];
                });
            return view('appviews.agrotech-dashboard', compact('data', 'result','tableauSaisons', 'tableauChiffreAffaires', 'produitsCommandes'));
        }
    }

    public function home(){
        $produits = Produit::whereHas('ventes', function ($query) {
            $query->where('status', 'encours');
        })->inRandomOrder()->limit(3)->get();
        $projets = Projet::inRandomOrder()->limit(3)->get();
        return view('appviews.acceuil-agrotech', compact('produits', 'projets'));
    }

    public function advises(){
        $offres = Offre::all();
        $conseils = Conseil::all();
        return view('appviews.agrotech-espaceconseil', compact('offres', 'conseils'));
    }

    public function projets_pubs(){
        
        $projets = Projet::all();
        return view('appviews.agrotech-pubs-projects', compact('projets'));
    }

    public function weathervue(){
        return view('appviews.weather-app');
    }
}
