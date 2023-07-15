<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Culture extends Model
{
    protected $table = 'cultures';

    protected $fillable = [
        'nom',
        'description',
        'date_debut',
        'date_fin',
        'parcelle_id'
    ];

    public function parcelle()
    {
        return $this->belongsTo(Parcelle::class);
    }

    public function agriculteur(){
        return $this->belongsTo(Agriculteur::class);
    }

    public function variete(){
        return $this->hasMany(Variete::class);
    }

}
