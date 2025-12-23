<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sidebar extends Model
{
    protected $fillable = [
        'name',
        'type',
        'status'
    ];
    
    public function permissions()
    {
        return $this->hasMany(UserPermission::class, 'sb_id');
    }
}
