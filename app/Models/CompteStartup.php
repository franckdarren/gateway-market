<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompteStartup extends Model
{
    protected $fillable = [
        'nom',
        'date_creation',
        'activite_principale',
        'email',
        'phone',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
