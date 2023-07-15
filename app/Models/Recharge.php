<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    use HasFactory;

    protected $table ='recharges';

    protected $fillable = ['amount', 'statut'];

    public function particulier(){
        return $this->belongsTo(Particulier::class);
    }
}
