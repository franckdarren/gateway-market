<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionLog extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'changed_at',
        'charge_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
