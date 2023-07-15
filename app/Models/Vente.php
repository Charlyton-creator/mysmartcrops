<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $table = 'ventes';

   
    protected $fillable = [
        'description',
        'duree',
        'saison_id',
    ];

    public function saison()
    {
        return $this->belongsTo(Saison::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'vente_produit');
    }
}
