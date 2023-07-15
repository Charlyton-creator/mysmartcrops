<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Flash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Particulier;
use App\Models\PanierItem;
use App\Models\PortefeuilParticulier;

class ParticulierController extends Controller
{
    //
    public function form(){
        return view('appviews.compte-particulier');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|unique:particuliers',
            'password' => 'required|string|min:8',
            'telephone' => 'required|string'
        ]);

        if ($validator->fails()) {
            //Si la validation échoue, rediriger avec les erreurs et afficher l'alerte d'erreur
            return redirect()->back()->withErrors($validator)->withInput()->with('popup', 'error');
        }

        $particulier = new Particulier();
        $particulier->noms = $request->nom;
        $particulier->email = $request->email;
        $particulier->password = Hash::make($request->password);
        $particulier->telephone = $request->telephone;
        $particulier->save();

        $portefeuil = new PortefeuilParticulier();

        $portefeuil->amount = 0;
        $portefeuil->particulier()->associate($particulier);

        $portefeuil->save();

        // Flash success message
        Session::flash('success', 'Vous avez creer votre compte avec succès. Connectez vous et completez votre profil!');
        // For example, you can redirect to the agriculteur's dashboard
        return redirect()->back()->with('popup', 'success');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('particulier')->attempt($credentials)) {
            // Authentication successful
            Session::flash('success', 'Connecté avec Succès!');
            return  redirect()->route('agrotech.dashboard');
        } else {
            // Authentication failed
            return back()->withErrors(['email' => 'Invalid email', 'password' => 'Invalid password']);
        }
    }

    public function show(Request $request, $id){
        if($id != null){
            $particulier = Particulier::find($id);

            return view('appviews.profile-particulier', compact('particulier'));
        }
    }

    public function updateform($id){
        if($id != null){
            $particulier = Particulier::find($id);

            return view('appviews.update-part', compact('particulier'));
        }
    }

    public function update(Request $request, $id){
        $particulier = Particulier::find($id);

        $particulier->noms = $request->noms;
        $particulier->prenoms = $request->prenoms;
        $particulier->sexe = $request->sexe;
        $particulier->email = $request->email;
        $particulier->telephone = $request->telephone;
        $particulier->ville = $request->ville;
        $particulier->region = $request->region;
        $particulier->compagnie = $request->compagnie;

        $particulier->save();

        return redirect('/particuliers/'.$particulier->id.'/details');
    }

    public function logout(){
        Auth::guard('particulier')->logout();

         // Rediriger vers la page d'acceuil AgroTech
         return $this->home();
    }

    public function cart(){
        if(auth('particulier')->Check()){
            $utilisateur = auth('particulier')->user();
            $panierItems = PanierItem::whereHas('panier', function ($query) use ($utilisateur) {
                $query->where('particulier_id', $utilisateur->id)
                      ->where('statut', 0);
            })->where('status', 0)->get();            
            return view('appviews.my-cart', compact('panierItems'));
        }
       
    }

    public function recharger(){
        if(auth('particulier')->Check()){         
            return view('appviews.recharger');
        }
    }

    public function callback(Request $request, $recharge_id){
        $transaction_id = $recharge_id;
        if(isset($_POST['field'])){
           
            switch($request['transaction-status']){
                case 'approved':
                    Recharge::where('id', $transaction_id)->update(['transaction_id' => $request['transaction-id'], 'statut' => 'approved']);
                    $particulier_id = Recharge::where('id', $transaction_id)->first()->particulier_id;
                    $portefeuil = PortefeuilParticulier::where('particulier_id', $particulier_id)->first();
                    $montant_init = $portefeuil->amount;
                    $amount = Recharge::where('id', $transaction_id)->first()->amount;
                    PortefeuilParticulier::where('particulier_id', $particulier_id)->update(['amount' => $montant_init + $amount]);
                    return redirect()->back()->with('payementsuccess', 'Payement effectué avec succes. Votre candidature est maintenant au complet et recupérable par l organisateur. Merci pour votre confiance');
                    break;
                case 'created':
                    break;
                case 'canceled':
                    Recharge::where('id', $transaction_id)->update(['transaction_id' => $request['transaction-id'], 'statut' => 'canceled']);
                    return redirect()->back()->with('payementcancelled', 'Vous avez annuler le payement. Si vous souhaitez continuer, veuillez relancer une transaction');
                    break;
                default:
                    return redirect()->back()->with('payementcancelled', 'Vous avez annuler le payement. Si vous souhaitez continuer, veuillez relancer une transaction');
                    break;
            }
        }
    }
}
