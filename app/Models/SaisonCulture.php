<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaisonCulture extends Model
{
    use HasFactory;
    protected $table = 'saison_cultures';
    protected $fillable = ['année', 'mois_debut', 'mois_fin'];

    public function cultures()
    {
        return $this->hasMany(Culture::class);
    }

    public function recoltes()
    {
        return $this->hasMany(Recolte::class);
    }
}
