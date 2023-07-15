<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Particulier;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\Panier;
use App\Models\PanierItem;
use Illuminate\Support\Facades\DB;
use App\Models\PortefeuilAgriculteur;
use App\Models\PortefeuilParticulier;
use App\Models\HistoriqueAchat;
use Flash;

class PanierController extends Controller
{
    //

    public function addToCart(Request $request){
         // Récupérer les données du formulaire
        $produitId = $request->input('productId');
        $quantite = $request->input('quantity', 1); // Si la quantité n'est pas renseignée, la valeur par défaut est 1

        // Vérifier si l'utilisateur est authentifié
        if (auth('particulier')->check()) {
            // Utilisateur connecté, associer le panier à l'utilisateur
            $panier = auth('particulier')->user()->panier;
        } else {
            // Utilisateur non connecté, récupérer ou créer un panier anonyme (à vous de décider comment vous gérez les paniers anonymes)
            return redirect()->back();
        }
            // Vérifier si le produit existe
        $produit = Produit::find($produitId);

        if (!$produit) {
            return response()->json(['error' => 'Le produit est introuvable'], 404);
        }

        if($produit->poids_base == 0 OR $produit->poids_base < $quantite) {
            return response()->json(['error' => 'Stock Epuisé'], 403);
        }

        // Vérifier si le produit existe déjà dans le panier
        $panierItem = $panier->panierItems()->where('produit_id', $produitId)->first();

        if ($panierItem->status == 0) {
            // Mettre à jour la quantité du produit dans le panier
            $panierItem->quantite += $quantite;
            $panierItem->save();
        } else {
            // Créer un nouvel élément dans le panier
            $panierItem = new PanierItem([
                'produit_id' => $produitId,
                'quantite' => $quantite,
                'prix' => $produit->prix
            ]);

            $panier->panierItems()->save($panierItem);
        }
        return response()->json(['success' => true]);
    }

    public function deleteFromCart(Request $request){
        // Récupérer l'ID de l'élément du panier à supprimer
        $panierItemId = $request->input('panierItemId');

        // Vérifier si l'utilisateur est authentifié
        if (auth('particulier')->check()) {
            // Utilisateur connecté, récupérer l'ID de l'utilisateur
            $userId = auth('particulier')->user()->id;

            // Rechercher et supprimer l'élément du panier associé à l'utilisateur
            PanierItem::where('id', $panierItemId)->whereHas('panier', function ($query) use ($userId) {
                $query->where('particulier_id', $userId);
            })->delete();
            $anierItem = PanierItem::where('id', $panierItemId)->whereHas('panier', function ($query) use ($userId) {
                $query->where('particulier_id', $userId);
            })->first();
            $produit = $panierItem->produit;

            $produit->poids_base += $panierItem->quantite;
            $produit->save();

        } else {
            return redirect()->back();
        }
    }

    public function paymentdetail(){
        if(auth('particulier')->check()){
            $currentcommande = Commande::whereHas('particulier', function ($query){
                $query->where('particulier_id', auth('particulier')->user()->id);
            })->first();
            $commandeId = $currentcommande->id;
            return view('appviews.paiementdetail', compact('commandeId'));
        }
    }

    public function updateItem(Request $request)
    {
        $panierItemId = $request->input('panierItemId');
        $quantite = $request->input('quantite');

        // Vérifier si l'élément du panier existe
        $panierItem = PanierItem::find($panierItemId);

        if (!$panierItem) {
            return response()->json(['success' => false, 'message' => 'Élément du panier introuvable']);
        }

        if($panierItem->produit->poids_base == 0 OR $panierItem->produit->poids_base < $quantite){
            return response()->json(['success' => false, 'message' => 'Stock Epuisé']);
        }

        if($panierItem->status == 0){
             // Mettre à jour la quantité de l'élément du panier
            $panierItem->quantite = $quantite;
            $panierItem->save();
        }
        // Calculer le sous-total de l'élément du panier
        $sousTotal = $panierItem->produit->prix * $quantite;

        return response()->json(['success' => true]);
    }


    public function validerPanier(Request $request)
    {

        if(!auth('particulier')->check()){
            return redirect()->back();
        }
        $Total = $request->input('sous_total');
        // Récupérer le panier de l'utilisateur actuel
        $panier = Panier::where('particulier_id', auth('particulier')->user()->id)
                        ->where('statut', 0)
                        ->first();

        if (!$panier) {
            // Gérer le cas où le panier n'existe pas ou n'est pas valide
            return response()->json(['message' => 'Panier introuvable ou invalide'], 404);
        }
        $portefeuil = auth('particulier')->user()->portefeuil;
        if($Total > $portefeuil->amount){
            return response()->json(['error_insufiscient_balance' => 'Balance Inssufissante, Veuillez recharger votre portefeuil et reessayer!' ],200);
        }

        // Mettre à jour le statut du panier à 1 (panier validé)
        $panier->statut = 1;
        $panier->save();

        // Créer une nouvelle commande
        $commande = new Commande();
        $commande->particulier_id = auth('particulier')->user()->id;
        $commande->total = $Total;
        $commande->date_emission = now()->format('Y-m-d');
        // Autres informations spécifiques à la commande
        $commande->save();

        // Mettre à jour les PanierItems avec l'ID de la commande
        PanierItem::where('panier_id', $panier->id)
                ->update(['commande_id' => $commande->id]);

        // Réduire les quantités de produits disponibles
        foreach ($panier->panierItems as $item) {
            $produit = $item->produit;
            $produit->poids_base -= $item->quantite;
            $produit->save();
        }

         // Débiter le compte de l'utilisateur particulier
         $utilisateurId = $commande->particulier_id;
         $montantTotal = $commande->total;

         $portefeuil = PortefeuilParticulier::where('particulier_id', $utilisateurId)->first();
         $montantdispo = $portefeuil->amount; 
        // Envoyer une réponse de succès à l'utilisateur
        return response()->json(['success' => 'Commande initialisée avec succès'], 200);
    }

    public function mettreAJourAdresseLivraison(Request $request, $id_commande)
    {
        // Récupérer l'adresse de livraison envoyée
        $adresseLivraison = $request->input('adresse');

        // Mettre à jour l'adresse de livraison dans la commande
        $commande = Commande::find($id_commande); // Récupérer la commande concernée
        $commande->adresse = $adresseLivraison;
        $commande->save();

        // Débiter le compte de l'utilisateur particulier
        $utilisateurId = $commande->particulier_id;
        $montantTotal = $commande->total;
        $this->debiterCompte($utilisateurId, $montantTotal);
        $panier = Panier::where('particulier_id', $utilisateurId)->where('statut', 1)->first();
        // Boucler sur les éléments du panier pour ajouter les fonds à l'agriculteur
        foreach ($panier->panierItems as $item) {
            $agriculteurId = $item->produit->agriculteur_id;
            $montant = $item->produit->prix * $item->quantite;
            $this->ajouterFondsAgriculteur($agriculteurId, $montant);

            $historiqueAchat = new HistoriqueAchat();

            $historiqueAchat->particulier_id = $utilisateurId;
            $historiqueAchat->produit_id = $item->produit->id;
            $historiqueAchat->quantite = $item->quantite;
            $historiqueAchat->total = $item->produit->prix * $item->quantite;
            $historiqueAchat->save();
            PanierItem::where('id', $item->id)->update(['status'=>1]);
        }

        // Mettre à jour le statut du panier à 0
        $panier->statut = 0;
        $panier->save();

        // Retourner la réponse JSON
        return response()->json(['success' => true, 'commande' => $commande]);
    }

    // Fonction pour débiter le compte de l'utilisateur particulier
    public function debiterCompte($utilisateurId, $montant)
    {
        // Effectuer les opérations pour débiter le compte de l'utilisateur
        // ...
        $portefeuil = PortefeuilParticulier::where('particulier_id', $utilisateurId)->first();
        $montantdispo = $portefeuil->amount;
        $portefeuil->amount = $montantdispo - $montant;
        $portefeuil->save();
    }

    // Fonction pour ajouter les fonds à l'agriculteur
    public function ajouterFondsAgriculteur($agriculteurId, $montant)
    {
        // Effectuer les opérations pour ajouter les fonds à l'agriculteur
        // ...
        $portefeuil = PortefeuilAgriculteur::where('agriculteur_id', $agriculteurId)->first();
        $montantdispo = $portefeuil->amount;

        $portefeuil->amount = $montantdispo + $montant;
        $portefeuil->save();
    }

}
