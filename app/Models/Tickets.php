<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $fillable = [
        'name',
        'type',
        'event_id',
        'status'
    ];

    public function event()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }
}
