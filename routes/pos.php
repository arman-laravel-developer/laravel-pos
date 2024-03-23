<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;


Route::middleware([ 'auth:sanctum',  config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/pos-index', [PosController::class, 'index'])->name('pos.index');
    Route::post('/pos/add-to-cart', [PosController::class, 'addToCart'])->name('add-to-cart');
    Route::post('/pos/update-cart-quantity', [PosController::class, 'updateCartQuantity'])->name('update-cart-quantity');
    Route::post('/pos/delete-from-cart', [PosController::class, 'deleteFromCart'])->name('delete-form-cart');
    Route::post('/pos/place-order', [PosController::class, 'placeOrder'])->name('place-order');

});
