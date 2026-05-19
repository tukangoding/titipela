@extends('layouts.app')

@section('content')

<div class="mb-4">
    <a href="/produk/{{ $city->slug }}/{{ $product->slug }}" class="text-sm text-gray-400 hover:text-brand">
        ← Kembali ke produk
    </a>
</div>

<h1 class="text-xl font-semibold mb-5">Form Pemesanan</h1>

<form action="/order/simpan" method="POST">
    @csrf

    <input type="hidden" name="product_id" value="{{ $product->id }}">

    {{-- Info produk --}}
    <div class="bg-white border border-gray-100 rounded-2xl p-4 mb-5 flex gap-3 items-center">
        <div class="text-4xl">{{ $product->emoji }}</div>
        <div>
            <div class="text-sm font-medium text-gray-800">{{ $product->name }}</div>
            <div class="text-xs text-gray-400">{{ $city->name }}</div>
            <div class="text-brand font-semibold text-sm mt-1">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </div>
        </div>
    </div>

    {{-- Data penerima --}}
    <div class="bg-white border border-gray-100 rounded-2xl p-4 mb-4">
        <div class="text-sm font-medium text-gray-700 mb-3">Data Penerima</div>
        <div class="flex flex-col gap-3">
            <div>
                <label class="text-xs text-gray-500 mb-1 block">Nama lengkap</label>
                <input type="text" name="customer_name" required placeholder="Budi Santoso"
                       class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
            </div>
            <div>
                <label class="text-xs text-gray-500 mb-1 block">No. WhatsApp (untuk notifikasi)</label>
                <input type="tel" name="wa_number" required placeholder="08xxxxxxxxxx"
                       class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
            </div>
            <div>
                <label class="text-xs text-gray-500 mb-1 block">Alamat lengkap</label>
                <textarea name="address" required rows="3" placeholder="Jl. Merdeka No.10, RT 03/RW 05..."
                          class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30"></textarea>
            </div>
            <div>
                <label class="text-xs text-gray-500 mb-1 block">Kota / Kabupaten tujuan</label>
                <input type="text" name="city" id="inp-city" required placeholder="Jakarta Selatan"
                       oninput="checkCOD(this.value)"
                       class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
                <div id="city-status" class="mt-1 text-xs"></div>
            </div>
            <div>
                <label class="text-xs text-gray-500 mb-1 block">Jumlah (maks. 10)</label>
                <input type="number" name="qty" value="1" min="1" max="10" required
                       oninput="recalcTotal()"
                       class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
            </div>
        </div>
    </div>

    {{-- Pilih pengiriman --}}
    <div class="bg-white border border-gray-100 rounded-2xl p-4 mb-4">
        <div class="text-sm font-medium text-gray-700 mb-3">Metode Pengiriman</div>
        <div class="flex flex-col gap-2" id="shipping-options">

            <label class="shipping-opt border border-brand rounded-xl p-3 cursor-pointer block"
                   data-cost="15000" data-cod="0">
                <input type="radio" name="shipping_method" value="jne_reguler" checked class="hidden"
                       onchange="selectShipping(15000, false)">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-sm font-medium text-gray-800">JNE Reguler</div>
                        <div class="text-xs text-gray-400">Estimasi 2–3 hari kerja</div>
                    </div>
                    <div class="text-sm font-medium">Rp 15.000</div>
                </div>
            </label>

            <label class="shipping-opt border border-gray-200 rounded-xl p-3 cursor-pointer block"
                   data-cost="25000" data-cod="0">
                <input type="radio" name="shipping_method" value="jne_express" class="hidden"
                       onchange="selectShipping(25000, false)">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-sm font-medium text-gray-800">JNE Express</div>
                        <div class="text-xs text-gray-400">Estimasi 1–2 hari kerja</div>
                    </div>
                    <div class="text-sm font-medium">Rp 25.000</div>
                </div>
            </label>

            <label class="shipping-opt border border-gray-200 rounded-xl p-3 cursor-pointer block" id="cod-label">
                <input type="radio" name="shipping_method" value="cod" class="hidden"
                       onchange="selectShipping(0, true)">
                <div class="flex justify-between items-center mb-1">
                    <div>
                        <div class="text-sm font-medium text-gray-800 flex items-center gap-2">
                            COD (Bayar di Tempat)
                            <span id="cod-badge" class="text-xs bg-gray-100 text-gray-400 px-2 py-0.5 rounded-full">cek kota dulu</span>
                        </div>
                        <div class="text-xs text-gray-400">Hanya area jangkauan jastip</div>
                    </div>
                    <div class="text-sm font-medium text-brand">Gratis</div>
                </div>
                <div id="cod-warning" class="hidden text-xs bg-red-50 text-red-500 rounded-lg px-3 py-2">
                    ⚠️ Kota ini di luar area COD. Disarankan pilih JNE.
                </div>
                <div id="cod-ok" class="hidden text-xs bg-green-50 text-green-600 rounded-lg px-3 py-2">
                    ✓ Kota ini masuk area COD!
                </div>
            </label>
        </div>

        {{-- Konfirmasi COD luar area --}}
        <div id="cod-confirm" class="hidden mt-3 bg-yellow-50 rounded-xl p-3">
            <label class="flex items-start gap-2 cursor-pointer">
                <input type="checkbox" name="cod_outside_area" value="1" class="mt-0.5">
                <span class="text-xs text-yellow-700">Saya mengerti COD tidak tersedia di kota saya, dan tetap memilih dengan risiko order bisa dibatalkan oleh tim.</span>
            </label>
        </div>
    </div>

    {{-- Ringkasan biaya --}}
    <div class="bg-white border border-gray-100 rounded-2xl p-4 mb-5">
        <div class="text-sm font-medium text-gray-700 mb-3">Ringkasan Biaya</div>
        <div class="flex justify-between text-sm text-gray-500 mb-2">
            <span>Harga produk</span>
            <span id="cost-produk">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between text-sm text-gray-500 mb-2">
            <span>Jasa titip (15%)</span>
            <span id="cost-jastip">Rp {{ number_format($product->price * 0.15, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between text-sm text-gray-500 mb-2">
            <span>Ongkos kirim</span>
            <span id="cost-ongkir">Rp 15.000</span>
        </div>
        <div class="border-t border-gray-100 pt-3 flex justify-between font-semibold">
            <span>Total</span>
            <span class="text-brand" id="cost-total">Rp {{ number_format($product->price * 1.15 + 15000, 0, ',', '.') }}</span>
        </div>
    </div>

    <button type="submit"
            class="w-full bg-brand hover:bg-brand-dark text-white font-medium py-3 rounded-xl transition">
        Lanjut ke Pembayaran (Midtrans)
    </button>
    <div class="text-center text-xs text-gray-400 mt-2">🔒 Transaksi aman · Notifikasi via WhatsApp</div>
</form>

<script>
const BASE_PRICE = {{ $product->price }};
const COD_WHITELIST = ['semarang','ungaran','salatiga','demak','kendal','batang','mranggen','tembalang','banyumanik','gunungpati'];
let ongkir = 15000;
let isCOD = false;
let cityIsValid = null;

function recalcTotal() {
    const qty = parseInt(document.querySelector('[name=qty]').value) || 1;
    const produk = BASE_PRICE * qty;
    const jastip = Math.round(produk * 0.15);
    const total = produk + jastip + ongkir;

    document.getElementById('cost-produk').textContent = 'Rp ' + produk.toLocaleString('id-ID');
    document.getElementById('cost-jastip').textContent = 'Rp ' + jastip.toLocaleString('id-ID');
    document.getElementById('cost-ongkir').textContent = ongkir === 0 ? 'Gratis (COD)' : 'Rp ' + ongkir.toLocaleString('id-ID');
    document.getElementById('cost-total').textContent = 'Rp ' + total.toLocaleString('id-ID');
}

function selectShipping(cost, cod) {
    ongkir = cost;
    isCOD = cod;
    document.querySelectorAll('.shipping-opt').forEach(el => {
        el.classList.remove('border-brand');
        el.classList.add('border-gray-200');
    });
    event.target.closest('.shipping-opt').classList.add('border-brand');
    event.target.closest('.shipping-opt').classList.remove('border-gray-200');
    document.getElementById('cod-confirm').classList.toggle('hidden', !(cod && cityIsValid === false));
    recalcTotal();
}

function checkCOD(val) {
    const key = val.toLowerCase().trim();
    const isValid = COD_WHITELIST.some(c => key.includes(c));
    cityIsValid = isValid;
    const badge = document.getElementById('cod-badge');
    const warn = document.getElementById('cod-warning');
    const ok = document.getElementById('cod-ok');
    const confirm = document.getElementById('cod-confirm');

    if (val.length < 3) {
        badge.textContent = 'cek kota dulu';
        badge.className = 'text-xs bg-gray-100 text-gray-400 px-2 py-0.5 rounded-full';
        warn.classList.add('hidden');
        ok.classList.add('hidden');
        confirm.classList.add('hidden');
        return;
    }

    if (isValid) {
        badge.textContent = '✓ area COD';
        badge.className = 'text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full';
        warn.classList.add('hidden');
        ok.classList.remove('hidden');
        confirm.classList.add('hidden');
    } else {
        badge.textContent = '✗ luar area';
        badge.className = 'text-xs bg-red-100 text-red-500 px-2 py-0.5 rounded-full';
        warn.classList.remove('hidden');
        ok.classList.add('hidden');
        confirm.classList.toggle('hidden', !isCOD);
    }
}
</script>

@endsection