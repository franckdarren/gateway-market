<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompteAdmin extends Model
{
    protected $fillable = [
        'solde'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
