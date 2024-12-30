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

        // Appeler la méthode rsi() et utiliser first() pour obtenir l'objet
        $rsi = $this->rsi()->first(); // Utilisez first() pour obtenir l'instance de Remboursement

        // Si le remboursement existe, récupérer le cumul_remboursement, sinon 0
        $rsiValue = $rsi ? $rsi->cumul_remboursement : 0;

        // Calculer le pourcentage de remboursement
        return $rsiValue > 0 ? ($sommeRemboursementsEffectues / $rsiValue) * 100 : 0;
    }

    // Calculer le RSI
    private function calculerRSI()
    {
        $montantInvestissement = $this->montant;
        $tauxInteret = $this->taux_interet;
        $nbreMoisRemboursement = $this->nbre_mois_remboursement;
        $nbreMoisGrace = $this->nbre_mois_grace;

        $capitalRestant = $montantInvestissement;
        $capitalTotalRestant = $capitalRestant;
        $cumulRemboursement = 0;

        for ($i = 1; $i <= $nbreMoisRemboursement + $nbreMoisGrace; $i++) {
            $remboursementCapital = 0;
            $remboursementInteret = 0;
            $interetDu = 0;

            // Calculer l'intérêt pendant la période de grâce
            if ($i <= $nbreMoisGrace) {
                $interetDu = floor($capitalRestant * ($tauxInteret / 100));
                $capitalRestant += $interetDu;
            }

            // Calculer les remboursements après la période de grâce
            if ($i > $nbreMoisGrace) {
                if ($i == $nbreMoisGrace + 1) {
                    $capitalTotalRestant = $capitalRestant;
                }

                $remboursementCapital = floor($capitalTotalRestant / $nbreMoisRemboursement);
                $remboursementInteret = floor($capitalRestant * ($tauxInteret / 100));
                $capitalRestant -= $remboursementCapital;
            }

            // Calculer le remboursement total pour le mois
            $remboursementTotal = $remboursementCapital + $remboursementInteret;
            $cumulRemboursement += $remboursementTotal;
        }

        return $cumulRemboursement;
    }


    public function getRsiAttribute()
    {
        // Accéder au premier remboursement via la relation 'rsi'
        $rsi = $this->rsi()->first(); // Utilisation de first() pour obtenir l'objet

        // Si un remboursement existe, retourner cumul_remboursement, sinon 0
        return $rsi ? $rsi->cumul_remboursement : 0;
    }
}
