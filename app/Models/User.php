<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    const STATUS = [
        0 => [
            'label' => 'Inactive',
            'color' => 'red'
        ],
        1 => [
            'label' => 'Active',
            'color' => 'green'
        ],
        2 => [
            'label' => 'Pending',
            'color' => 'yellow'
        ],
    ];

    const GENDER = [
        0 => 'Male',
        1 => 'Female',
        2 => 'Other',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'first_name',
        'last_name',
        'phone_number',
        'city',
        'dob',
        'gender',
        'country',
        'zip_code',
        'address',
        'image',
        'email',
        'password',
        'is_email_sent',
        'is_email_resent',
        'is_active',
        'role_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'dob' => 'date',
        'is_email_sent' => 'boolean',
        'is_email_resent' => 'boolean',
        'is_active' => 'boolean',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function events()
    {
        return $this->hasMany(Events::class, 'created_by', 'id');
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function scopePending($query)
    {
        return $query->where('is_active', 2);
    }
    public function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }
    public function scopeMerchants($query)
    {
        return $query->where('role_id', 2);
    }
    public function getGenderAttribute($value)
    {
        return self::GENDER[$value];
    }
    public function getStatusAttribute()
    {
        $status = $this->attributes['is_active'] ?? 0;
        return self::STATUS[$status] ?? [
            'label' => 'Unknown',
            'color' => 'grey'
        ];
    }
    public function sidebars()
    {
        return $this->hasManyThrough(
            Sidebar::class,
            UserPermission::class,
            'role_id',     // FK on user_permissions
            'id',          // FK on sidebars
            'role_id',     // FK on users
            'sb_id'        // FK on user_permissions
        )->where('sidebars.status', 1);
    }

    public function isAdmin(): bool
    {
        return $this->role?->type === 'admin';
    }

    public function isMerchant(): bool
    {
        return $this->role?->type === 'merchant';
    }

    public function routePrefix(): string
    {
        return match ($this->role?->type) {
            'admin' => 'admin',
            'merchant' => 'merchant',
            default => 'admin', // fallback
        };
    }
}
