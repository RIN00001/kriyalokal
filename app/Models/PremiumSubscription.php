<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PremiumSubscription extends Model
{
    protected $fillable = [
    'seller_id',
    'plan_name',
    'price',
    'status',
    'starts_at',
    'ends_at',
];

protected $casts = [
    'starts_at' => 'datetime',
    'ends_at' => 'datetime',
];

public function seller()
{
    return $this->belongsTo(Seller::class);
}
}
