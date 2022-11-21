<?php

use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::resource('products', ProductController::class)->except([
    'show'
])->except('show');
Route::get('discounts', [DiscountController::class, 'index'])->name('discounts.index');
Route::get('discounts/create', [DiscountController::class, 'create'])->name('discounts.create');
Route::post('discounts', [DiscountController::class, 'store'])->name('discounts.store');
Route::get('discounts/{discount}/edit', [DiscountController::class, 'edit'])->name('discounts.edit');
Route::put('discounts/{discount}', [DiscountController::class, 'update'])->name('discounts.update');
Route::delete('discounts/{discountId}', [DiscountController::class, 'destroy'])->name('discounts.destroy');
