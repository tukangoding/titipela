<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Batch;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $city = $product->city;
        return view('order.create', compact('product', 'city'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'      => 'required|exists:products,id',
            'customer_name'   => 'required|string|max:100',
            'wa_number'       => 'required|string|max:20',
            'address'         => 'required|string',
            'city'            => 'required|string',
            'shipping_method' => 'required|in:jne_reguler,jne_express,cod',
            'qty'             => 'required|integer|min:1|max:10',
        ]);

        $product = Product::findOrFail($request->product_id);

        $shippingCosts = [
            'jne_reguler' => 15000,
            'jne_express' => 25000,
            'cod'         => 0,
        ];

        $shippingCost = $shippingCosts[$request->shipping_method];
        $productTotal = $product->price * $request->qty;
        $serviceFee   = (int) round($productTotal * 0.15);
        $total        = $productTotal + $serviceFee + $shippingCost;

        // Cari batch aktif untuk kota ini
        $batch = Batch::where('city_id', $product->city_id)
                      ->where('status', 'open')
                      ->first();

        $order = Order::create([
            'batch_id'        => $batch?->id,
            'order_code'      => 'TTP-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4)),
            'customer_name'   => $request->customer_name,
            'wa_number'       => $request->wa_number,
            'address'         => $request->address,
            'city'            => $request->city,
            'is_cod'          => $request->shipping_method === 'cod',
            'cod_outside_area'=> $request->boolean('cod_outside_area'),
            'shipping_method' => $request->shipping_method,
            'shipping_cost'   => $shippingCost,
            'service_fee'     => $serviceFee,
            'total'           => $total,
            'status'          => 'pending_payment',
        ]);

        $order->items()->create([
            'product_id' => $product->id,
            'qty'        => $request->qty,
            'price'      => $product->price,
        ]);

        return redirect()->route('order.tracking', $order->order_code);
    }

    public function tracking(string $orderCode)
    {
        $order = Order::with(['items.product', 'batch'])
                      ->where('order_code', $orderCode)
                      ->firstOrFail();

        return view('order.tracking', compact('order'));
    }
}