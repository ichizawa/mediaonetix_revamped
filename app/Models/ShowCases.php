<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShowCases extends Model
{
    use SoftDeletes;

    protected $table = 'showcases';
    
    protected $fillable = [
        'user_id',
        'event_id',
        'position',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function event()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }
}
