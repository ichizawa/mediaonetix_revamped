<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCodes extends Model
{
    
    protected $fillable = [
        'slug',
        'amount',
        'type',
        'event_id',
        'user_id',
        'status',
        'valid',
        'quantity'
    ];

    public function event()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }
}
