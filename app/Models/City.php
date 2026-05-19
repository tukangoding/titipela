<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name', 'slug', 'is_cod_available', 'lat', 'lng', 'is_active'
    ];

    protected $casts = [
        'is_cod_available' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }
}