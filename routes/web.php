<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

// Landing page
Route::get('/', [HomeController::class, 'index'])->name('home');

// API produk per kota (AJAX)
Route::get('/api/products/{city}', [ProductController::class, 'byCity'])->name('api.products');

// Detail produk
Route::get('/produk/{city}/{product}', [ProductController::class, 'show'])->name('product.show');

// Order
Route::get('/order/buat', [OrderController::class, 'create'])->name('order.create');
Route::post('/order/simpan', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/tracking/{orderCode}', [OrderController::class, 'tracking'])->name('order.tracking');