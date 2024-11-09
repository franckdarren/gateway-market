<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    protected $fillable = [
        'nom_projet',
        'description_projet',
        'montant',
        'nbre_mois_remboursement',
        'nbre_mois_grace',
        'taux_interet',
        'url_business_plan',
        'url_etude_risque',
        'van',
        'ir',
        'tri',
        'krl',
        'compte_startup_id',
        'compte_investisseur_id',
    ];

    public function compteStartup()
    {
        return $this->belongsTo(CompteStartup::class);
    }

    public function compteInvestisseur()
    {
        return $this->belongsTo(CompteInvestisseur::class);
    }
}
