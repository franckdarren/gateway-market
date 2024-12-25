<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant',
        'type',
        'description',
        'compte_type',
        'mode_retrait',
        'nom_compte',
        'numero_compte',
        'compte_id',
        'statut',
        'offre_id',

        'frais',
        'numero_transaction'
    ];

    public function compte()
    {
        return $this->morphTo();
    }

    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }

}
