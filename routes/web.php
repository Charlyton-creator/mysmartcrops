<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgriculteurController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ParticulierController;
use App\Http\Controllers\InvestisseurController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ParcelleController;
use App\Http\Controllers\SaisonCultureController;
use App\Http\Controllers\CultureController;
use App\Http\Controllers\VarieteController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\RechargController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('appviews.acceuil-agrotech');
// });

Route::get('/product/detail', function(){
    return view('appviews.product-detail');
});

Route::get('/comptes/particulier', function(){
    return view('appviews.compte-particulier');
});

Route::get('/comptes/agriculteur', function(){
    return view('appviews.compte-agriculteur');
});

Route::get('/dashboard', function(){
    return view('appviews.agrotech-dashboard');
});

Route::controller(Controller::class)->group(function(){
    Route::get('/dashboard', 'dashboard')->name('agrotech.dashboard');
    Route::get('/', 'home')->name('agrotech.home');
    Route::get('/espace-conseils', 'advises');
    Route::get('/projets-pubs', 'projets_pubs')->name('agrotech.projets');
    Route::get('/weather-app', 'weathervue');
});

Route::controller(AgriculteurController::class)->group(function(){
    Route::get('/comptes/agriculteur', 'form');
    Route::post('/agriculteurs/register', 'register');
    Route::post('/agriculteurs/login', 'login')->name('agriculteur.login');
    Route::get('/agriculteurs/logout', 'logout');
    Route::middleware('auth:agriculteur')->group(function(){
        Route::get('/agriculteurs/{id}/details', 'show');
        Route::get('/agriculteurs/{id}/showupdateform', 'updateform');
        Route::post('/agriculteurs/{id}/update', 'update');
        Route::get('/store', 'mystore');
    });
});

Route::controller(ProduitController::class)->group(function(){
    Route::get('/espace-marche', 'index');
    Route::get('/products/{id}/details', 'show');
    Route::get('products/recents', 'recents');
    Route::middleware('auth:agriculteur')->group(function(){
        Route::get('/store/add_produit', 'viewaddproduct');
        Route::put('/store/produit/{id}/update', 'update');
        Route::get('/store/produit/{id}/detail', 'mystore');
        Route::post('/produit/add', 'store');
        Route::put('/produit/{produitId}/vendre', 'setProductVenteStatus')->name('vendreproduit');
    });
});

Route::controller(ParticulierController::class)->group(function(){
    Route::get('/comptes/particulier', 'form');
    Route::post('/particuliers/register', 'register');
    Route::post('/particuliers/login', 'login');
    Route::get('/particuliers/logout', 'logout');
    Route::middleware('auth:particulier')->group(function(){
        Route::get('/particuliers/recharger-compte', 'recharger')->name('recharge-portefeuil');
        Route::get('/particuliers/{id}/details', 'show');
        Route::get('/particuliers/{id}/showupdateform', "updateform");
        Route::post('/particuliers/{id}/update', 'update');
        Route::get('/mycart', 'cart');
        Route::get('profile', 'userprofil');
    });
});

Route::controller(InvestisseurController::class)->group(function(){
    Route::get('/comptes/investisseur', 'form');
    Route::post('/investisseurs/register', 'register');
    Route::post('/investisseurs/login', 'login');
    Route::get('/investisseurs/logout', 'logout');
    Route::middleware('auth:investisseur')->group(function(){
        Route::get('/investisseurs/{id}/details', 'show');
        Route::get('/investisseurs/{id}/showupdateform', 'updateform');
        Route::post('/investisseurs/{id}/update', 'update');
    });
});

Route::controller(ParcelleController::class)->group(function(){
    Route::middleware('auth:agriculteur')->group(function (){
        Route::get('/agriculteur/parcelle/add', 'storeview');
        Route::post('/parcelle/store', 'store');
    });
});

Route::controller(VarieteController::class)->group(function (){
    Route::middleware('auth:agriculteur')->group(function (){
        Route::get('/agriculteur/variete/add', 'storeview');
        Route::post('/variete/store', 'store');
    });
});

Route::controller(CultureController::class)->group(function (){
    Route::middleware('auth:agriculteur')->group(function (){
        Route::get('/agriculteur/culture/add', 'storeview');
        Route::post('/culture/store', 'store');
    });
});

Route::controller(PlantController::class)->group(function (){
    Route::middleware('auth:agriculteur')->group(function (){
        Route::get('/agriculteur/plant/add', 'storeview');
        Route::post('/plant/store', 'store');
    });
});

Route::controller(SaisonCultureController::class)->group(function (){
    Route::middleware('auth:agriculteur')->group(function (){
        Route::get('/agriculteur/saison_culture/add', 'storeview');
        Route::post('/saison_culture/store', 'store');
    });
});

Route::controller(PanierController::class)->group(function (){
    // Routes pour l'ajout au panier
    Route::post('/ajouter-au-panier', 'addToCart')->name('panier.ajouter');

    // Routes pour la suppression d'éléments du panier
    Route::post('/supprimer-du-panier', 'deleteFromCart')->name('panier.supprimer');

    Route::post('/modifier-element', 'updateItem')->name('panier.mettre-a-jour');

    Route::post('valider-panier', 'validerPanier')->middleware('checkportefeuil');

    Route::get('/payement-details', 'paymentdetail');

    Route::put('/{id_commande}/livraison_place', 'mettreAJourAdresseLivraison');

});

Route::controller(RechargController::class)->group(function (){
    // Routes pour l'ajout au panier
    Route::post('/initialiser-recharge', 'initialiser');
    Route::post('/payement/callback/{recharge_id}', 'callback')->name('callbackurl');
});


Route::controller(ProjetController::class)->group(function (){
    // Routes pour l'ajout au panier
    Route::get('/submit-projet/index', 'submitprojectview');
    Route::post('/submit-projet/store', 'store');
});

Route::controller(NotificationController::class)->group(function (){
    Route::get('/notifications', 'index');
});