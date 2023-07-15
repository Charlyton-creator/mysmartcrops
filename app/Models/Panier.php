<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;

    protected $table = 'paniers';

    protected $hidden = [
        "etat"
    ];

    public function particulier(){
        return $this->belongsTo(Particulier::class);
    }

    public function panierItems(){
        return $this->hasMany(PanierItem::class);
    }
}
