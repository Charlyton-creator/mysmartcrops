<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = [
        'image_source',
        'description',
        'produit_id',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
