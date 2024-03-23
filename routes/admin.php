<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware([ 'auth:sanctum',  config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');

    Route::get('/pos-index', [PosController::class, 'index'])->name('pos.index');
    Route::post('/pos/add-to-cart', [PosController::class, 'addToCart'])->name('add-to-cart');
    Route::post('/pos/update-cart-quantity', [PosController::class, 'updateCartQuantity'])->name('update-cart-quantity');
    Route::post('/pos/delete-from-cart', [PosController::class, 'deleteFromCart'])->name('delete-form-cart');
    Route::post('/pos/place-order', [PosController::class, 'placeOrder'])->name('place-order');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
});
