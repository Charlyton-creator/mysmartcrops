<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;
    protected $table = 'plants';

    protected $fillable = [
        'libelle',
        'date_semence',
        'engrais_utilises',
        'date_entretien_1',
        'date_entretien_2',
        'date_entretien_3',
        'variete_id',
        'saison_culture_id',
        'agriculteur_id'
    ];

    public function agriculteur(){
        return $this->belongsTo(Agriculteur::class);
    }
    public function variete()
    {
        return $this->belongsTo(Variete::class);
    }

    public function saisonCulture()
    {
        return $this->belongsTo(SaisonCulture::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
