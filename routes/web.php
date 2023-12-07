<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home.home');
});

Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
Route::get('/cart', [ProductController::class, 'cart'])->name('cart');
Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::post('/pay', [ProductController::class, 'pay'])->name('pay');
