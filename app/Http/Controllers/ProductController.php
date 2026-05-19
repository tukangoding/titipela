<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\City;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(string $citySlug, string $productSlug)
    {
        $city = City::where('slug', $citySlug)->firstOrFail();
        $product = Product::where('slug', $productSlug)
                          ->where('city_id', $city->id)
                          ->where('is_active', true)
                          ->firstOrFail();

        return view('product.show', compact('city', 'product'));
    }

    // API: produk per kota (untuk filter AJAX)
    public function byCity(Request $request, string $citySlug)
    {
        $city = City::where('slug', $citySlug)->firstOrFail();
        $products = Product::where('city_id', $city->id)
                           ->where('is_active', true)
                           ->when($request->category, fn($q) =>
                               $q->where('category', $request->category)
                           )
                           ->when($request->search, fn($q) =>
                               $q->where('name', 'like', '%'.$request->search.'%')
                           )
                           ->get();

        return response()->json($products);
    }
}