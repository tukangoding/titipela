<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        'city_id', 'cutoff_at', 'pickup_at', 'shipped_at', 'status'
    ];

    protected $casts = [
        'cutoff_at'  => 'datetime',
        'pickup_at'  => 'datetime',
        'shipped_at' => 'datetime',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}