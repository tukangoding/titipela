<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'batch_id', 'order_code', 'customer_name', 'wa_number',
        'address', 'city', 'is_cod', 'cod_outside_area',
        'shipping_method', 'shipping_cost', 'service_fee', 'total',
        'status', 'tracking_number',
        'midtrans_snap_token', 'midtrans_transaction_id'
    ];

    protected $casts = [
        'is_cod'            => 'boolean',
        'cod_outside_area'  => 'boolean',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}