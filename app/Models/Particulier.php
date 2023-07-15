<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Particulier extends Authenticatable
{
    protected $table = 'particuliers';

    protected $fillable = [
        'noms',
        'prenoms',
        'sexe',
        'compagnie',
        'email',
        'telephone',
        'ville',
        'region',
    ];

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function portefeuil(){
        return $this->hasOne(PortefeuilParticulier::class);
    }

    public function panier(){
        return $this->hasOne(Panier::class);
    }

    public function recharges(){
        return $this->hasMany(Recharge::class);
    }

     /**
     * 
     */
    public function notifications(){
        return $this->hasMany(Notification::class);
    }
}
