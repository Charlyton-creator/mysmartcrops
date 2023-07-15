<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investisseur;
use Validator;
use Flash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InvestisseurController extends Controller
{
    //
    public function form(){
        return view('appviews.compte-investisseur');
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|unique:investisseurs',
            'password' => 'required|string|min:8',
            'telephone' => 'required|string'
        ]);

        if ($validator->fails()) {
            // Si la validation échoue, rediriger avec les erreurs et afficher l'alerte d'erreur
            return redirect()->back()->withErrors($validator)->withInput()->with('popup', 'error');
        }

        $investisseur = new Investisseur();
        $investisseur->noms = $request->nom;
        $investisseur->email = $request->email;
        $investisseur->password = Hash::make($request->password);
        $investisseur->telephone = $request->telephone;
        $investisseur->save();

        // Flash success message
        Session::flash('success', 'Vous avez creer votre compte avec succès. Connectez vous et completez votre profil!');
        // For example, you can redirect to the agriculteur's dashboard
        return redirect()->back()->with('popup', 'success');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('investisseur')->attempt($credentials)) {
            // Authentication successful
            Session::flash('success', 'Connecté avec Succès!');
            return  redirect()->route('agrotech.dashboard');
        } else {
            // Authentication failed
            return redirect()->back()->withErrors(['email' => 'Invalid email', 'password' => 'Invalid password'])->withInput()->with('popup', 'error');
        }
    }

    public function show(Request $request, $id){
        if($id != null){
            $investisseur = Investisseur::find($id);
            return view('appviews.profile-investisseur', compact('investisseur'));
        }
    }

    /**
     * 
     */
    public function updateform($id){
        if($id != null){
            $investisseur = Investisseur::find($id);

            return view('appviews.update-invest', compact('investisseur'));
        }
    }

    public function update(Request $request, $id){
        if($id != null){
            $investisseur = Investisseur::find($id);

            $investisseur->noms = $request->noms;
            $investisseur->prenoms = $request->prenoms;
            $investisseur->sexe = $request->sexe;
            $investisseur->email = $request->email;
            $investisseur->telephone = $request->telephone;
            $investisseur->ville = $request->ville;
            $investisseur->pays = $request->pays;
            $investisseur->fonction = $request->fonction;

            $investisseur->save();

            return redirect('/investisseurs/'.$investisseur->id.'/details');
        }
    }

    public function logout(){
        Auth::guard('investisseur')->logout();
         // Rediriger vers la page d'acceuil AgroTech
         return redirect()->route('agrotech.home');
    }

}
