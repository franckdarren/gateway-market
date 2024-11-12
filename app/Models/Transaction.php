<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant',
        'type',
        'description',
        'compte_type',

        'compte_id',
        'offre_id',

    ];

    public function compte()
    {
        return $this->morphTo();
    }
}
