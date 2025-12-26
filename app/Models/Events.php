<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    const STATUS = [
        0 => [
            'label' => 'Upcoming',
            'color' => 'warning'
        ],
        1 => [
            'label' => 'Active',
            'color' => 'success'
        ],
        2 => [
            'label' => 'Ongoing',
            'color' => 'primary'
        ],
        3 => [
            'label' => 'Completed',
            'color' => 'secondary'
        ],
        4 => [
            'label' => 'Cancelled',
            'color' => 'danger'
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
        'created_by'
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
    public function scopeGetEventByMerchant($query, $merchant_id)
    {
        return $query->where('created_by', $merchant_id);
    }
    public function tickets()
    {
        
    }
}
