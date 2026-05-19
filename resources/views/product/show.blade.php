@extends('layouts.app')

@section('content')

<div class="mb-4">
    <a href="/?kota={{ $city->slug }}" class="text-sm text-gray-400 hover:text-brand">
        ← Kembali ke {{ $city->name }}
    </a>
</div>

{{-- Gambar produk --}}
<div class="bg-gray-50 rounded-2xl h-56 flex items-center justify-center text-8xl mb-5">
    {{ $product->emoji }}
</div>

{{-- Info produk --}}
<div class="mb-5">
    <div class="text-xs text-gray-400 uppercase tracking-wide mb-1">{{ ucfirst($product->category) }} · {{ $city->name }}</div>
    <h1 class="text-2xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h1>
    <div class="flex items-center gap-2 mb-3">
        <span class="text-yellow-400">★★★★★</span>
        <span class="text-sm text-gray-400">{{ $product->rating }} · {{ $product->total_sold }} terjual</span>
    </div>
    <div class="text-2xl font-bold text-brand mb-1">
        Rp {{ number_format($product->price, 0, ',', '.') }}
    </div>
    <div class="text-xs text-gray-400">belum termasuk jasa titip (15%) & ongkir</div>
</div>

{{-- Deskripsi --}}
<div class="bg-white border border-gray-100 rounded-2xl p-4 mb-5">
    <div class="text-sm font-medium text-gray-700 mb-2">Deskripsi</div>
    <div class="text-sm text-gray-500 leading-relaxed">{{ $product->description }}</div>
    @if($product->stock_note)
        <div class="mt-3 text-xs text-brand bg-brand-light px-3 py-1.5 rounded-lg inline-block">
            📦 {{ $product->stock_note }}
        </div>
    @endif
</div>

{{-- Tombol pesan --}}
<a href="/order/buat?product_id={{ $product->id }}"
   class="block w-full bg-brand hover:bg-brand-dark text-white text-center font-medium py-3 rounded-xl transition">
    Pesan Sekarang
</a>

@endsection