<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
            protected $fillable = [
            'user_id',
            'shop_name',
            'slug',
            'description',
            'banner_image',
            'status',
        ];

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function products()
        {
            return $this->hasMany(Product::class);
        }

        public function orderItems()
        {
            return $this->hasMany(OrderItem::class);
        }

        public function premiumSubscription()
        {
            return $this->hasOne(PremiumSubscription::class);
        }

        public function reports()
        {
            return $this->hasMany(SellerReport::class);
        }
        
}
