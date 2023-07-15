<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortefeuilParticulier extends Model
{
    use HasFactory;
    protected $table = "particuliers_portefeuil";

    protected $fillable = ['amount'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'amount'
    ];

    public function particulier(){
        return $this->belongsTo(Particulier::class);
    }
}
