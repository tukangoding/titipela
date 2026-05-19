<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\City;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Semarang
            [
                'city'        => 'semarang',
                'name'        => 'Lumpia Semarang',
                'slug'        => 'lumpia-semarang',
                'description' => 'Lumpia original dari Gang Lombok, tersedia basah dan kering. Isi ayam + udang + rebung.',
                'price'       => 45000,
                'category'    => 'makanan',
                'emoji'       => '🥢',
                'rating'      => 4.9,
                'total_sold'  => 312,
                'stock_note'  => 'Tersedia setiap hari',
            ],
            [
                'city'        => 'semarang',
                'name'        => 'Wingko Babat',
                'slug'        => 'wingko-babat',
                'description' => 'Kue tradisional khas Semarang dari tepung ketan dan kelapa.',
                'price'       => 32000,
                'category'    => 'makanan',
                'emoji'       => '🍡',
                'rating'      => 4.7,
                'total_sold'  => 198,
                'stock_note'  => 'Tersedia setiap hari',
            ],
            [
                'city'        => 'semarang',
                'name'        => 'Bandeng Presto',
                'slug'        => 'bandeng-presto',
                'description' => 'Ikan bandeng presto tanpa duri, bumbu rempah khas Semarang.',
                'price'       => 65000,
                'category'    => 'makanan',
                'emoji'       => '🐟',
                'rating'      => 4.8,
                'total_sold'  => 87,
                'stock_note'  => 'Stok terbatas',
            ],
            [
                'city'        => 'semarang',
                'name'        => 'Teh Poci',
                'slug'        => 'teh-poci',
                'description' => 'Teh poci khas Tegal-Semarang, aroma melati yang kuat.',
                'price'       => 28000,
                'category'    => 'minuman',
                'emoji'       => '🫖',
                'rating'      => 4.6,
                'total_sold'  => 54,
                'stock_note'  => 'Tersedia setiap hari',
            ],

            // Solo
            [
                'city'        => 'solo',
                'name'        => 'Serabi Solo',
                'slug'        => 'serabi-solo',
                'description' => 'Serabi tradisional khas Solo dengan kuah santan manis.',
                'price'       => 30000,
                'category'    => 'makanan',
                'emoji'       => '🥞',
                'rating'      => 4.8,
                'total_sold'  => 201,
                'stock_note'  => 'Tersedia setiap hari',
            ],
            [
                'city'        => 'solo',
                'name'        => 'Intip Solo',
                'slug'        => 'intip-solo',
                'description' => 'Kerupuk nasi khas Solo, renyah dengan taburan gula merah.',
                'price'       => 25000,
                'category'    => 'makanan',
                'emoji'       => '🟤',
                'rating'      => 4.5,
                'total_sold'  => 89,
                'stock_note'  => 'Tersedia setiap hari',
            ],
            [
                'city'        => 'solo',
                'name'        => 'Batik Lurik',
                'slug'        => 'batik-lurik',
                'description' => 'Kain lurik tenun tangan asli Solo, motif klasik.',
                'price'       => 185000,
                'category'    => 'kerajinan',
                'emoji'       => '🧶',
                'rating'      => 4.9,
                'total_sold'  => 43,
                'stock_note'  => 'Stok terbatas',
            ],

            // Yogyakarta
            [
                'city'        => 'yogyakarta',
                'name'        => 'Bakpia Pathok',
                'slug'        => 'bakpia-pathok',
                'description' => 'Bakpia isi kacang hijau asli Pathok, Yogyakarta.',
                'price'       => 38000,
                'category'    => 'makanan',
                'emoji'       => '🥮',
                'rating'      => 4.9,
                'total_sold'  => 520,
                'stock_note'  => 'Tersedia setiap hari',
            ],
            [
                'city'        => 'yogyakarta',
                'name'        => 'Gudeg Kaleng',
                'slug'        => 'gudeg-kaleng',
                'description' => 'Gudeg Jogja dalam kemasan kaleng, tahan hingga 1 tahun.',
                'price'       => 55000,
                'category'    => 'makanan',
                'emoji'       => '🥘',
                'rating'      => 4.7,
                'total_sold'  => 145,
                'stock_note'  => 'Tersedia setiap hari',
            ],
            [
                'city'        => 'yogyakarta',
                'name'        => 'Kerajinan Perak',
                'slug'        => 'kerajinan-perak',
                'description' => 'Perhiasan perak Kotagede buatan tangan pengrajin lokal.',
                'price'       => 220000,
                'category'    => 'kerajinan',
                'emoji'       => '💍',
                'rating'      => 4.8,
                'total_sold'  => 31,
                'stock_note'  => 'Stok terbatas',
            ],

            // Surabaya
            [
                'city'        => 'surabaya',
                'name'        => 'Sambal Bu Rudy',
                'slug'        => 'sambal-bu-rudy',
                'description' => 'Sambal legendaris Surabaya, pedas gurih dengan udang rebon.',
                'price'       => 42000,
                'category'    => 'makanan',
                'emoji'       => '🌶️',
                'rating'      => 5.0,
                'total_sold'  => 890,
                'stock_note'  => 'Tersedia setiap hari',
            ],
            [
                'city'        => 'surabaya',
                'name'        => 'Lapis Kukus Pahlawan',
                'slug'        => 'lapis-kukus-pahlawan',
                'description' => 'Lapis kukus khas Surabaya dengan berbagai varian rasa.',
                'price'       => 70000,
                'category'    => 'makanan',
                'emoji'       => '🍰',
                'rating'      => 4.8,
                'total_sold'  => 203,
                'stock_note'  => 'Tersedia setiap hari',
            ],

            // Bandung
            [
                'city'        => 'bandung',
                'name'        => 'Batagor',
                'slug'        => 'batagor',
                'description' => 'Batagor Bandung asli dengan saus kacang dan kecap.',
                'price'       => 35000,
                'category'    => 'makanan',
                'emoji'       => '🍢',
                'rating'      => 4.7,
                'total_sold'  => 167,
                'stock_note'  => 'Tersedia setiap hari',
            ],
            [
                'city'        => 'bandung',
                'name'        => 'Peuyeum Bandung',
                'slug'        => 'peuyeum-bandung',
                'description' => 'Tape singkong fermentasi khas Bandung, manis dan lembut.',
                'price'       => 28000,
                'category'    => 'makanan',
                'emoji'       => '🎋',
                'rating'      => 4.5,
                'total_sold'  => 99,
                'stock_note'  => 'Stok terbatas',
            ],
        ];

        foreach ($products as $item) {
            $city = City::where('slug', $item['city'])->first();
            if ($city) {
                Product::create([
                    'city_id'     => $city->id,
                    'name'        => $item['name'],
                    'slug'        => $item['slug'],
                    'description' => $item['description'],
                    'price'       => $item['price'],
                    'category'    => $item['category'],
                    'emoji'       => $item['emoji'],
                    'rating'      => $item['rating'],
                    'total_sold'  => $item['total_sold'],
                    'stock_note'  => $item['stock_note'],
                    'is_active'   => true,
                ]);
            }
        }
    }
}