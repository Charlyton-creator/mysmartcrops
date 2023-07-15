<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $table = 'produits';

    protected $fillable = [
        'nom',
        'prix',
        'poids_base',
        'agriculteur_id',
        'culture_id',
    ];

    public function agriculteur()
    {
        return $this->belongsTo(Agriculteur::class);
    }
    public function culture()
    {
        return $this->belongsTo(Culture::class);
    }

    public function ventes()
    {
        return $this->belongsToMany(Vente::class, 'vente_produit');
    }

    public function publicites()
    {
        return $this->belongsToMany(Publicite::class, 'produit_publicite');
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function commandes(){
        return $this->belongsToMany(Commande::class, 'commande_produit');
    }

    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }

    public function panieritems(){
        return $this->hasMany(PanierItem::class);
    }
}
