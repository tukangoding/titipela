<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            [
                'name'             => 'Semarang',
                'slug'             => 'semarang',
                'is_cod_available' => true,
                'lat'              => -6.9932,
                'lng'              => 110.4203,
                'is_active'        => true,
            ],
            [
                'name'             => 'Solo',
                'slug'             => 'solo',
                'is_cod_available' => true,
                'lat'              => -7.5755,
                'lng'              => 110.8243,
                'is_active'        => true,
            ],
            [
                'name'             => 'Yogyakarta',
                'slug'             => 'yogyakarta',
                'is_cod_available' => true,
                'lat'              => -7.7956,
                'lng'              => 110.3695,
                'is_active'        => true,
            ],
            [
                'name'             => 'Surabaya',
                'slug'             => 'surabaya',
                'is_cod_available' => false,
                'lat'              => -7.2575,
                'lng'              => 112.7521,
                'is_active'        => true,
            ],
            [
                'name'             => 'Bandung',
                'slug'             => 'bandung',
                'is_cod_available' => false,
                'lat'              => -6.9175,
                'lng'              => 107.6191,
                'is_active'        => true,
            ],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}