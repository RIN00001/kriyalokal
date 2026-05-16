<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
protected $fillable = [
    'order_id',
    'payment_gateway',
    'payment_type',
    'transaction_id',
    'snap_token',
    'redirect_url',
    'gross_amount',
    'status',
    'paid_at',
    'raw_response',
];

protected $casts = [
    'paid_at' => 'datetime',
    'raw_response' => 'array',
];

public function order()
{
    return $this->belongsTo(Order::class);
}

}
