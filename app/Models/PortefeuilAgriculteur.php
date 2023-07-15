<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortefeuilAgriculteur extends Model
{
    use HasFactory;

    protected $table = "agriculteurs_portefeuil";

    protected $fillable = ['amount'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'amount'
    ];

    public function agriculteur(){
        return $this->belongsTo(Agriculteur::class);
    }
}
