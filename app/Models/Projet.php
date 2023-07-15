<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    protected $table = 'projets';

    protected $fillable = [
        'designation',
        'description',
        'document_descriptif',
        'agriculteur_id',
    ];

    public function agriculteur()
    {
        return $this->belongsTo(Agriculteur::class);
    }

    public function investisseurs()
    {
        return $this->belongsToMany(Investisseur::class, 'investisseur_projet');
    }
}