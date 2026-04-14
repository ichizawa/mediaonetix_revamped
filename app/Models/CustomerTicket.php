<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerTicket extends Model
{
       protected $fillable = [
        'sale_id',
        'reference_num',
        'qr_path',
        'is_redeemed',
        'is_disabled',
        'scanned_by'
    ];

    public function sale()
    {
        return $this->belongsTo(Sales::class);
    }
      public function ticket()
    {
        return $this->belongsTo(Tickets::class, 'ticket_id', 'id');
    }
}
