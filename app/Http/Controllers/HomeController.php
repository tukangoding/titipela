<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::where('is_active', true)->get();

        // Deteksi kota dari query param, default Semarang
        $citySlug = $request->query('kota', 'semarang');
        $currentCity = City::where('slug', $citySlug)
                           ->where('is_active', true)
                           ->firstOrFail();

        $products = Product::where('city_id', $currentCity->id)
                           ->where('is_active', true)
                           ->get();

        return view('home', compact('cities', 'currentCity', 'products'));
    }
}