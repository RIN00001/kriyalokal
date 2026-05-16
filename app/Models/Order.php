<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const TAX_RATE = 0.05;

    protected $fillable = [
        'user_id',
        'order_code',
        'total_amount',
        'status',
        'payment_status',
        'midtrans_order_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public static function taxAmountForSubtotal(float|int $subtotal): int
    {
        return (int) round($subtotal * self::TAX_RATE);
    }

    public static function totalWithTax(float|int $subtotal): int
    {
        return (int) round($subtotal) + self::taxAmountForSubtotal($subtotal);
    }

    public function subtotalAmount(): int
    {
        if (! $this->relationLoaded('items')) {
            $this->load('items');
        }

        return (int) round($this->items->sum('subtotal'));
    }

    public function taxAmount(): int
    {
        return self::taxAmountForSubtotal($this->subtotalAmount());
    }

    public function totalAmountWithTax(): int
    {
        return self::totalWithTax($this->subtotalAmount());
    }
}
