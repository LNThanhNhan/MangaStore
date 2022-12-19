<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
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
//Employee route
Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('employees/{employeeId}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('employees/{employeeId}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('employees/{employeeId}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
//User route với user controller từ folder admin
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
//Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
//Order route
Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('orders/{orderID}', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('orders/{orderID}', [OrderController::class, 'update'])->name('orders.update');
//Dashboard route
Route::get('home', [HomeController::class, 'index'])->name('home.index');
