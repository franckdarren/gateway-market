<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
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
