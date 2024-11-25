<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remboursement extends Model
{
    protected $fillable = [
        'offre_id',
        'compte_startup_id',
        'compte_investisseur_id',
        'mois',
        'capital_restant',
        'interet_du',
        'remboursement_capital',
        'remboursement_interet',
        'remboursement_total',
        'cumul_remboursement',
        
    ];
}
