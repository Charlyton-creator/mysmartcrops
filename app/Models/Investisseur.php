<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Investisseur extends Authenticatable
{
    protected $table = 'investisseurs';

    protected $fillable = [
        'noms',
        'prenoms',
        'telephone',
        'region',
        'ville',
        'email',
    ];

    public function projets()
    {
        return $this->belongsToMany(Projet::class, 'investisseur_projet');
    }
     /**
     * 
     */
    public function notifications(){
        return $this->hasMany(Notification::class);
    }
}
