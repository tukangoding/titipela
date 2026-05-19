@extends('layouts.app')

@section('content')

{{-- Hero --}}
<div class="bg-gradient-to-br from-brand to-brand-dark rounded-2xl p-6 mb-6 text-white">
    <div class="text-xs uppercase tracking-widest opacity-75 mb-1">kamu lagi di</div>
    <div class="text-3xl font-semibold mb-1">{{ $currentCity->name }} 📍</div>
    <div class="text-sm opacity-85 mb-4">kami beliin, kami kirim. oleh-oleh asli, tanpa ribet.</div>
    <div class="flex flex-wrap gap-2">
        <span class="bg-white/20 rounded-lg px-3 py-2 text-xs">✓ Beli hari ini</span>
        <span class="bg-white/20 rounded-lg px-3 py-2 text-xs">🚚 Kirim ke seluruh Indonesia</span>
        <span class="bg-white/20 rounded-lg px-3 py-2 text-xs">💬 Update via WhatsApp</span>
    </div>
</div>

{{-- Cutoff notice --}}
<div class="bg-yellow-50 border border-yellow-200 rounded-xl px-4 py-3 mb-6 flex items-center gap-3">
    <span class="text-yellow-500 text-lg">⏰</span>
    <div>
        <span class="text-sm font-medium text-yellow-700">Cutoff order hari ini: Jumat, 17.00 WIB</span>
        <span class="text-xs text-gray-500 ml-2">— order sekarang, dikirim Senin</span>
    </div>
</div>

{{-- Pilih kota --}}
<div class="mb-6">
    <div class="text-sm text-gray-500 mb-3 font-medium">Pilih kota oleh-oleh</div>
    <div class="flex flex-wrap gap-2">
        @foreach($cities as $city)
            <a href="/?kota={{ $city->slug }}"
               class="px-4 py-2 rounded-full text-sm border transition
               {{ $city->id === $currentCity->id
                   ? 'bg-brand text-white border-transparent'
                   : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                {{ $city->name }}
            </a>
        @endforeach
    </div>
</div>

{{-- Search & filter --}}
<div class="flex gap-3 mb-5">
    <input type="text" id="search-input" placeholder="cari oleh-oleh..."
           oninput="filterProducts()"
           class="flex-1 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
    <select id="cat-filter" onchange="filterProducts()"
            class="border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
        <option value="">semua kategori</option>
        <option value="makanan">makanan</option>
        <option value="minuman">minuman</option>
        <option value="kerajinan">kerajinan</option>
    </select>
</div>

{{-- Product grid --}}
<div id="product-grid" class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-10">
    @forelse($products as $product)
        <a href="/produk/{{ $currentCity->slug }}/{{ $product->slug }}"
           class="product-card bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-md transition group"
           data-name="{{ strtolower($product->name) }}"
           data-category="{{ $product->category }}">

            {{-- Emoji image --}}
            <div class="h-36 bg-gray-50 flex items-center justify-center text-5xl group-hover:scale-110 transition-transform">
                {{ $product->emoji }}
            </div>

            <div class="p-3">
                <div class="text-xs text-gray-400 mb-1">{{ ucfirst($product->category) }}</div>
                <div class="text-sm font-medium text-gray-800 leading-tight mb-1">{{ $product->name }}</div>
                <div class="flex items-center gap-1 mb-2">
                    <span class="text-yellow-400 text-xs">★</span>
                    <span class="text-xs text-gray-400">{{ $product->rating }} · {{ $product->total_sold }} terjual</span>
                </div>
                <div class="text-brand font-semibold text-sm">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </div>
                <div class="text-xs text-gray-400">+ jasa titip & ongkir</div>
            </div>
        </a>
    @empty
        <div class="col-span-3 text-center py-12 text-gray-400">
            <div class="text-4xl mb-3">📦</div>
            <div class="text-sm">Belum ada produk untuk kota ini.</div>
        </div>
    @endforelse
</div>

{{-- Cara kerja --}}
<div class="border-t border-gray-100 pt-8">
    <div class="text-base font-semibold mb-4 text-gray-700">cara pesan</div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        @foreach([
            ['📍','1. pilih kota','otomatis deteksi lokasimu'],
            ['🛒','2. pilih produk','oleh-oleh asli dari kota itu'],
            ['💸','3. bayar','harga produk + jasa titip'],
            ['📦','4. kami kirim','update status via WhatsApp'],
        ] as $step)
        <div class="bg-gray-50 rounded-xl p-4 text-center">
            <div class="text-2xl mb-2">{{ $step[0] }}</div>
            <div class="text-xs font-medium text-gray-700 mb-1">{{ $step[1] }}</div>
            <div class="text-xs text-gray-400">{{ $step[2] }}</div>
        </div>
        @endforeach
    </div>
</div>

<script>
function filterProducts() {
    const search = document.getElementById('search-input').value.toLowerCase();
    const cat = document.getElementById('cat-filter').value;
    document.querySelectorAll('.product-card').forEach(card => {
        const matchSearch = card.dataset.name.includes(search);
        const matchCat = !cat || card.dataset.category === cat;
        card.style.display = matchSearch && matchCat ? 'block' : 'none';
    });
}
</script>

@endsection