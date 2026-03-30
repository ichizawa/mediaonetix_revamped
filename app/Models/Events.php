<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Events extends Model
/**
 * Scope a query to only include upcoming events with non-trashed showcases.
 */

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
        'seat_plan',
        'event_date',
        'event_time',
        'event_venue',
        'event_total_tickets',
        'status',
        'created_by',
        'tickets_sold',
        'slug',
        'crop_x',
        'crop_y',
        'crop_width',
        'crop_height',
        'crop_natural_width',
        'crop_natural_height',
    ];
    protected $appends = ['status_label', 'percentage', 'total_tickets_left', 'event_image_url', 'seat_plan_url'];

    public function getStatusLabelAttribute()
    {
        $status = $this->attributes['status'] ?? 0;
        return self::STATUS[$status] ?? [
            'label' => 'Unknown',
            'color' => 'secondary'
        ];
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

    public function scopeGetUpcoming()
    {
        return $this->where('event_date', '>=', date('Y-m-d'));
    }

    public function scopeUpcomingWithShowcases($query)
    {
        return $query->where('event_date', '>=', date('Y-m-d'))
            ->whereHas('showcases', function ($q) {
                $q->whereNull('deleted_at');
            });
    }
    public function showcases()
    {
        return $this->hasMany(ShowCases::class, 'event_id');
    }
    public function latestShowcase()
    {
        return $this->hasOne(ShowCases::class, 'event_id')->latestOfMany();
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
    public function getPercentageAttribute()
    {
        $totalTickets = $this->tickets->sum('original_qty');
        $soldTickets = $this->tickets_sold;
        return $totalTickets > 0 ? ($soldTickets / $totalTickets) * 100 : 0;
    }
    public function getEventImageUrlAttribute()
    {
        return asset('images/events/' . $this->event_image);
    }
    public function getSeatPlanUrlAttribute()
    {
        return $this->seat_plan ? asset('images/events/seat_plan/' . $this->seat_plan) : null;
    }
}
