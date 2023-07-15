<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saison extends Model
{
    protected $table = 'saisons';

    protected $fillable = [
        'annee',
        'mois',
        'debut',
        'fin',
    ];

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

    public function publicites()
    {
        return $this->hasMany(Publicite::class);
    }
}
