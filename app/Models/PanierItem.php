<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanierItem extends Model
{
    use HasFactory;

    protected $table = 'panier_items';

    protected $fillable = ['panier_id', 'produit_id', 'quantite', 'prix'];

    public function panier(){
        return $this->belongsTo(Panier::class);
    }

    public function produit(){
        return $this->belongsTo(Produit::class);
    }
    
    public function commande(){
        return $this->belongsTo(Commande::class);
    }
}
