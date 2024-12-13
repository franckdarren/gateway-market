<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompteStartup extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'date_creation',
        'activite_principale',
        'email',
        'phone',
        'user_id',
        'solde'

    ];

    public function getNomCompletAttribute()
    {
        return "{$this->nom}";
    }

    public function getMorphClass()
    {
        return 'Compte Startup';
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
