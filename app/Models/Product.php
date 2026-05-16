<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
protected $fillable = [
    'seller_id',
    'category_id',
    'name',
    'slug',
    'description',
    'price',
    'stock',
    'selling_type',
    'external_url',
    'is_active',
];

public function seller()
{
    return $this->belongsTo(Seller::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}

public function images()
{
    return $this->hasMany(ProductImage::class);
}

public function mainImage()
{
    return $this->hasOne(ProductImage::class)->where('is_main', true);
}

public function cartItems()
{
    return $this->hasMany(CartItem::class);
}

public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

}
