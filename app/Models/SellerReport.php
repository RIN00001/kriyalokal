<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerReport extends Model
{
    protected $fillable = [
    'seller_id',
    'edited_by',
    'report_type',
    'title',
    'description',
    'data_json',
    'generated_at',
];

protected $casts = [
    'data_json' => 'array',
    'generated_at' => 'datetime',
];

public function seller()
{
    return $this->belongsTo(Seller::class);
}

public function editor()
{
    return $this->belongsTo(User::class, 'edited_by');
}
}
