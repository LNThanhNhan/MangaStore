<?php

use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

//user info routes
Route::get('/', [UserController::class, 'profile'])->name('profile.info');
Route::put('/', [UserController::class, 'update'])->name('profile.update');

//user cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::put('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
//delete theo ajax
Route::delete('/cart/delete/', [CartController::class, 'deleteCart'])->name('cart.delete');
//áp dụng mã giảm giá theo ajax
Route::put('/cart/discount', [CartController::class, 'applyDiscount'])->name('cart.discount');
//xóa mã giảm giá trong giỏ hàng theo ajax
Route::put('/cart/remove-discount', [CartController::class, 'removeDiscount'])->name('cart.remove-discount');

///user order routes
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout.index');
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
