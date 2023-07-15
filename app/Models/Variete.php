<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variete extends Model
{
    protected $table = 'varietes';

    protected $fillable = [
        'libelle',
        'code',
        'agriculteur_id',
    ];

    public function agriculteur()
    {
        return $this->belongsTo(Agriculteur::class);
    }

    public function culture(){
        return $this->belongsTo(Culture::class);
    }
}
