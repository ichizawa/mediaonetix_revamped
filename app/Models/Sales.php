<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Sales extends Model
{
    use SoftDeletes;

    const STATUS = [
        0 => [
            'label' => 'Pending',
            'color' => 'text-yellow-400',
        ],
        1 => [
            'label' => 'Completed',
            'color' => 'text-green-400',
        ],
        2 => [
            'label' => 'Cancelled',
            'color' => 'text-red-400',
        ],
    ];

    const PURCHASE_TYPE = [
        0 => 'Online',
        1 => 'Walk-in',
    ];

    protected $fillable = [
        'ticket_id',
        'event_id',
        'promo_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'customer_city',
        'customer_birthdate',
        'quantity',
        'total_amount',
        'status',
        'payment_intent_id',
        'payment_method',
        'purchase_type',
        'transaction_id',
        'reference_id',
        'reference_number',
        'is_online',
        'is_paid',
        'is_tracked',
        'is_email_sent',
        'is_email_resent',
        'is_sms_sent',
        'is_sms_resent',
    ];

    public function getStatusLabelAttribute()
    {
        $status = $this->attributes['status'] ?? 0;
        return self::STATUS[$status] ?? [
            'label' => 'Unknown',
            'color' => 'secondary'
        ];
    }
    public static function revenueByDayOfWeek($merchantId)
    {
        return self::getAllSalesByMerchant($merchantId)
            ->select(
                DB::raw('DAYOFWEEK(created_at) as day_number'),
                DB::raw('SUM(total_amount) as total_revenue')
            )
            ->groupBy('day_number')
            ->orderBy('day_number');
    }
    public function getPurchaseTypeLabelAttribute()
    {
        return self::PURCHASE_TYPE[$this->purchase_type];
    }

    protected $casts = [
        'is_online' => 'boolean',
        'is_paid' => 'boolean',
        'is_tracked' => 'boolean',
        'is_email_sent' => 'boolean',
        'is_email_resent' => 'boolean',
        'is_sms_sent' => 'boolean',
        'is_sms_resent' => 'boolean',
        'reference_number' => 'string',
    ];

    public function ticket()
    {
        return $this->belongsTo(Tickets::class, 'ticket_id');
    }

    public function event()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }

    public static function getAllSalesByMerchant($merchantId)
    {
        return self::whereHas('event', function ($query) use ($merchantId) {
            $query->where('created_by', $merchantId);
        })->with(['event', 'ticket']);
    }
}
