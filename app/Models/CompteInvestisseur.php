<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompteInvestisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'pays',
        'etat_province',
        'ville',
        'code_postal',
        'phone',
        'email',
        'profession',
        'user_id',
        'solde'
    ];

    public function getNomCompletAttribute()
    {
        return "{$this->nom} {$this->prenom}";
    }

    public function getMorphClass()
    {
        return 'Compte Investisseur';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'compte');
    }

    public function offres()
    {
        return $this->hasMany(Offre::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Offre::class, 'favorites', 'compte_investisseur_id', 'offre_id');
    }

    // Cumul des remboursements
    public function totalRemboursements()
    {
        return $this->offres()->with('remboursements')
            ->get()
            ->flatMap(function ($offre) {
                return $offre->remboursements->where('statut', 'Remboursé');
            })
            ->sum('remboursement_total');
    }

    // Cumul des investissements
    public function totalInvestissement()
    {
        return $this->offres()
            ->get()
            ->sum('montant');
    }
}
