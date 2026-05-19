<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'city_id', 'name', 'slug', 'description',
        'price', 'category', 'emoji', 'rating',
        'total_sold', 'stock_note', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}