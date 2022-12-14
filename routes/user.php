<?php

use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

//user info routes
Route::get('/', [UserController::class, 'profile'])->name('profile.info');
Route::put('/{userId}/edit', [UserController::class, 'update'])->name('profile.update');

//user cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::put('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
//delete theo ajax
Route::delete('/cart/delete/', [CartController::class, 'deleteCart'])->name('cart.delete');
//áp dụng mã giảm giá theo ajax
Route::put('/cart/discount', [CartController::class, 'applyDiscount'])->name('cart.discount');
//xóa mã giảm giá trong giỏ hàng theo ajax
Route::put('/cart/remove-discount', [CartController::class, 'removeDiscount'])->name('cart.remove_discount');

//user order routes
//Đặt đơn hàng
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout.index');
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
//Xem danh sách đơn hàng
Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
Route::put('/orders/{orderId}', [OrderController::class, 'cancel'])->name('order.cancel');
Route::get('/orders/{orderId}', [OrderController::class, 'show'])->name('order.show');
