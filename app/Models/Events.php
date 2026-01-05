<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Events extends Model
{
    use SoftDeletes;

    const STATUS = [
        0 => [
            'label' => 'Upcoming',
            'color' => 'yellow'
        ],
        1 => [
            'label' => 'Active',
            'color' => 'green'
        ],
        2 => [
            'label' => 'Ongoing',
            'color' => 'blue'
        ],
        3 => [
            'label' => 'Completed',
            'color' => 'grey'
        ],
        4 => [
            'label' => 'Cancelled',
            'color' => 'red'
        ]
    ];
    protected $fillable = [
        'event_name',
        'category',
        'description',
        'event_image',
        'event_date',
        'event_time',
        'event_venue',
        'event_total_tickets',
        'status',
        'created_by',
        'tickets_sold',
        'slug'
    ];

    protected $appends = ['status_label'];

    public function getStatusLabelAttribute()
    {
        $status = $this->attributes['status'] ?? 0;
        return self::STATUS[$status] ?? [
            'label' => 'Unknown',
            'color' => 'secondary'
        ];
    }
    public function scopeGetUpcoming()
    {
        return $this->where('event_date', '>=', date('Y-m-d'));
    }
    public function scopeGetThisWeek()
    {
        return $this->where('event_date', '>=', date('Y-m-d'))->orderByDesc('id');
    }
    public function scopeGetActive()
    {
        return $this->where('status', 1);
    }
    public function scopeGetEventByMerchant($query, $merchant_id)
    {
        return $query->where('created_by', $merchant_id);
    }
    public function tickets()
    {
        return $this->hasMany(Tickets::class, 'event_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            $baseSlug = Str::slug($event->event_name);
            $slug = $baseSlug;
            $count = 1;

            while (static::withTrashed()->where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }

            $event->slug = $slug;
        });
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getTotalTicketsLeftAttribute()
    {
        return $this->tickets->sum('quantity');
    }
}
