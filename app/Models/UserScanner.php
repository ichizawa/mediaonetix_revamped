<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserScanner extends Model
{
    protected $fillable = [
        'user_id',
        'scanning_count',
        'last_scanned',
        'is_active',
        'is_archived',
        'device_id',
        'security_pin',
    ];
}
