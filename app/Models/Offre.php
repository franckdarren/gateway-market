<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offre extends Model
{
    use HasFactory;

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
        'statut',

    ];

    public function compteStartup()
    {
        return $this->belongsTo(CompteStartup::class);
    }

    public function compteInvestisseur()
    {
        return $this->belongsTo(CompteInvestisseur::class);
    }

    public function remboursements()
    {
        return $this->hasMany(Remboursement::class);
    }
}
