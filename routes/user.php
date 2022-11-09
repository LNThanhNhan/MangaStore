<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

//user info routes
Route::get('/', [UserController::class, 'profile'])->name('profile.info');
Route::put('/', [UserController::class, 'update'])->name('profile.update');
//user cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::put('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
//delete theo api
Route::delete('/cart/delete/', [CartController::class, 'deleteCart'])->name('cart.delete');
