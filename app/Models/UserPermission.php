<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $fillable = [
        'role_id',
        'sb_id',
        'user_id',
        'permission_name',
    ];
    public function sidebar()
    {
        return $this->belongsTo(Sidebar::class, 'sb_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
