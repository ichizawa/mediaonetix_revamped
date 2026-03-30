<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tickets extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'type',
        'event_id',
        'status',
        'color',
        'price',
        'quantity',
        'original_qty',
        'inclusions'
    ];

    public function event()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }
}
