<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicite extends Model
{
    protected $table = 'publicites';

    protected $fillable = [
        'libelle',
        'image_descriptive',
        'public_cible',
        'saison_id',
    ];

    public function saison()
    {
        return $this->belongsTo(Saison::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'produit_publicite');
    }
}
