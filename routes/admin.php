<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::resource('products', ProductController::class)->except([
    'show'
])->except('show');
//Discount route
Route::get('discounts', [DiscountController::class, 'index'])->name('discounts.index');
Route::get('discounts/create', [DiscountController::class, 'create'])->name('discounts.create');
Route::post('discounts', [DiscountController::class, 'store'])->name('discounts.store');
Route::get('discounts/{discount}/edit', [DiscountController::class, 'edit'])->name('discounts.edit');
Route::put('discounts/{discount}', [DiscountController::class, 'update'])->name('discounts.update');
Route::delete('discounts/{discountId}', [DiscountController::class, 'destroy'])->name('discounts.destroy');
//Article route
Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('articles', [ArticleController::class, 'store'])->name('articles.store');
Route::get('articles/{articleId}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('articles/{articleId}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('articles/{articleId}', [ArticleController::class, 'destroy'])->name('articles.destroy');
