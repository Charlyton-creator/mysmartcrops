<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Agriculteur extends Authenticatable
{
    protected $table = 'agriculteurs';

    protected $fillable = [
        'nom',
        'prenoms',
        'sexe',
        'age',
        'telephone',
        'region',
        'ville',
        'village',
        'ferme',
        'association',
    ];

    public function projets()
    {
        return $this->hasMany(Projet::class);
    }

    public function parcelles()
    {
        return $this->hasMany(Parcelle::class);
    }

    public function varietes()
    {
        return $this->hasMany(Variete::class);
    }

    public function portefeuil(){
        return $this->hasOne(PortefeuilAgriculteur::class);
    }

    public function cultures(){
        return $this->hasMany(Culture::class);
    }

    public function recoltes(){
        return $this->hasMany(Recolte::class);
    }

    public function plants(){
        return $this->hasMany(Plant::class);
    }
    public function produits(){
        return $this->hasMany(Produit::class);
    }

    /**
     * 
     */
    public function notifications(){
        return $this->hasMany(Notification::class);
    }
}
