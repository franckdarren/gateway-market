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
}
