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
        'url_image',

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

    public function favoritedBy()
    {
        return $this->belongsToMany(CompteInvestisseur::class, 'favorites')->withTimestamps();
    }

    public function isFavoris()
    {
        $compteInvestisseur = auth()->user()->compteInvestisseur;

        if (!$compteInvestisseur) {
            return false;
        }

        return $compteInvestisseur->favorites()->where('offre_id', $this->id)->exists();
    }

    // Récupérer le RSI
    public function rsi()
    {
        return $this->hasOne(Remboursement::class)->latest('id');
    }

    // Récupérer les remboursements déja éffectués
    public function sommeRemboursementsEffectues()
    {
        return $this->remboursements()
            ->where('statut', 'Remboursé')
            ->sum('remboursement_total');
    }

    // Récupérer le pourcentage de remboursement
    public function pourcentageRemboursement()
    {
        // Récupérer la somme des remboursements effectués et le RSI
        $sommeRemboursementsEffectues = $this->sommeRemboursementsEffectues();
        $rsi = $this->rsi ? $this->rsi->cumul_remboursement : 0;

        // Calculer le pourcentage
        return $rsi > 0 ? ($sommeRemboursementsEffectues / $rsi) * 100 : 0;
    }
}
