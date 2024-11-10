<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompteInvestisseur extends Model
{
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'compte');
    }
}
