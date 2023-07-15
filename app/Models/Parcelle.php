<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcelle extends Model
{
    use HasFactory;

    protected $table = "parcelles";

    protected $fillable = ['lieu', 'etendu', 'agriculteur_id'];

    public function agriculteur(){
        return $this->belongsTo(Agriculteur::class);
    }
    public function cultures(){
        return $this->hasMany(Culture::class);
    }
}
