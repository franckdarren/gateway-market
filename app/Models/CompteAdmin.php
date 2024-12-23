<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompteAdmin extends Model
{
    use HasFactory;

    protected $fillable = [
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

    public function getMorphClass()
    {
        return 'Compte Admin';
    }
}
