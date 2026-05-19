@extends('layouts.app')

@section('content')

<div class="text-center mb-6">
    <div class="text-4xl mb-2">📦</div>
    <h1 class="text-xl font-semibold text-gray-800">Status Pesanan</h1>
    <div class="text-sm text-gray-400 mt-1">{{ $order->order_code }}</div>
</div>

{{-- Status badge --}}
@php
$statusMap = [
    'pending_payment' => ['label' => 'Menunggu Pembayaran', 'color' => 'bg-yellow-100 text-yellow-700'],
    'processing'      => ['label' => 'Diproses', 'color' => 'bg-blue-100 text-blue-700'],
    'buying'          => ['label' => 'Sedang Dibelikan', 'color' => 'bg-orange-100 text-orange-700'],
    'shipped'         => ['label' => 'Dalam Pengiriman', 'color' => 'bg-purple-100 text-purple-700'],
    'done'            => ['label' => 'Selesai ✓', 'color' => 'bg-green-100 text-green-700'],
    'cancelled'       => ['label' => 'Dibatalkan', 'color' => 'bg-red-100 text-red-700'],
];
$s = $statusMap[$order->status];
@endphp

<div class="flex justify-center mb-6">
    <span class="px-4 py-2 rounded-full text-sm font-medium {{ $s['color'] }}">
        {{ $s['label'] }}
    </span>
</div>

{{-- Detail order --}}
<div class="bg-white border border-gray-100 rounded-2xl p-4 mb-4">
    <div class="text-sm font-medium text-gray-700 mb-3">Detail Pesanan</div>
    @foreach($order->items as $item)
    <div class="flex items-center gap-3 mb-2">
        <div class="text-3xl">{{ $item->product->emoji }}</div>
        <div class="flex-1">
            <div class="text-sm font-medium text-gray-800">{{ $item->product->name }}</div>
            <div class="text-xs text-gray-400">{{ $item->qty }} × Rp {{ number_format($item->price, 0, ',', '.') }}</div>
        </div>
        <div class="text-sm font-medium text-gray-700">
            Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}
        </div>
    </div>
    @endforeach
    <div class="border-t border-gray-100 pt-3 mt-2 flex justify-between font-semibold">
        <span class="text-sm">Total Bayar</span>
        <span class="text-brand">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
    </div>
</div>

{{-- Info pengiriman --}}
<div class="bg-white border border-gray-100 rounded-2xl p-4 mb-4">
    <div class="text-sm font-medium text-gray-700 mb-3">Info Pengiriman</div>
    <div class="text-sm text-gray-600 space-y-1">
        <div>👤 {{ $order->customer_name }}</div>
        <div>📱 {{ $order->wa_number }}</div>
        <div>📍 {{ $order->address }}, {{ $order->city }}</div>
        <div>🚚 {{ str_replace('_', ' ', ucfirst($order->shipping_method)) }}</div>
        @if($order->tracking_number)
        <div>🏷️ Resi: <strong>{{ $order->tracking_number }}</strong></div>
        @endif
    </div>
</div>

{{-- Timeline --}}
<div class="bg-white border border-gray-100 rounded-2xl p-4 mb-6">
    <div class="text-sm font-medium text-gray-700 mb-4">Riwayat Status</div>
    @php
    $steps = [
        ['key' => 'pending_payment', 'label' => 'Menunggu Pembayaran', 'desc' => 'Order dibuat, menunggu konfirmasi pembayaran.'],
        ['key' => 'processing',      'label' => 'Pembayaran Diterima',  'desc' => 'Pembayaran berhasil, masuk antrian batch.'],
        ['key' => 'buying',          'label' => 'Sedang Dibelikan',     'desc' => 'Tim jastip sedang membeli produk di toko.'],
        ['key' => 'shipped',         'label' => 'Dalam Pengiriman',     'desc' => 'Paket diserahkan ke kurir.'],
        ['key' => 'done',            'label' => 'Pesanan Selesai',      'desc' => 'Paket telah diterima. Terima kasih!'],
    ];
    $statusOrder = array_column($steps, 'key');
    $currentIndex = array_search($order->status, $statusOrder);
    @endphp

    <div class="relative">
        @foreach($steps as $i => $step)
        <div class="flex gap-4 pb-5 relative {{ $loop->last ? '' : '' }}">
            @if(!$loop->last)
            <div class="absolute left-[15px] top-8 bottom-0 w-px bg-gray-100"></div>
            @endif
            <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 z-10 text-sm
                {{ $i < $currentIndex ? 'bg-green-100 text-green-600' :
                   ($i === $currentIndex ? 'bg-brand text-white' : 'bg-gray-100 text-gray-400') }}">
                {{ $i < $currentIndex ? '✓' : ($i === $currentIndex ? '⏳' : '○') }}
            </div>
            <div class="pt-1">
                <div class="text-sm font-medium {{ $i <= $currentIndex ? 'text-gray-800' : 'text-gray-400' }}">
                    {{ $step['label'] }}
                </div>
                @if($i <= $currentIndex)
                <div class="text-xs text-gray-400 mt-0.5">{{ $step['desc'] }}</div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="text-center text-xs text-gray-400">
    Ada pertanyaan? Hubungi kami via WhatsApp 💬
</div>

@endsection