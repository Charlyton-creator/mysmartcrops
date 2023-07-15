<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recolte extends Model
{
    use HasFactory;
    protected $table = 'recoltes';
    protected $fillable = ['mois', 'jour', 'poids_engendre','saison_culture_id'];

    public function saisonCulture()
    {
        return $this->belongsTo(SaisonCulture::class);
    }

    public function agriculteur(){
        return $this->belongsTo(Agriculteur::class);
    }
}
