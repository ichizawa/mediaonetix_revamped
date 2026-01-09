<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantFiles extends Model
{
    const STATUS = [
        0 => [
            'label' => 'Pending',
            'color' => 'yellow',
        ],
        1 => [
            'label' => 'Approved',
            'color' => 'green',
        ],
        2 => [
            'label' => 'Rejected',
            'color' => 'red',
        ],
    ];
    protected $fillable = [
        'file_name',
        'file_path',
        'merchant_id',
        'status',
    ];

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    public function getStatusAttribute()
    {
        $status = $this->attributes['status'] ?? 0;
        return self::STATUS[$status] ?? [
            'label' => 'Unknown',
            'color' => 'grey'
        ];
    }
}
