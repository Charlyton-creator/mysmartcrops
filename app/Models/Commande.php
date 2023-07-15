<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = "commandes";

    public function panieritems(){
        return $this->hasMany(PanierItem::class);
    }

    public function particulier(){
        return $this->belongsTo(Particulier::class);
    }
}
