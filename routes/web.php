<?php

use App\Http\Controllers\Home\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'index'])->name('home.index');
Route::get('/products/search',[HomeController::class,'searchProducts'])->name('home.search');
Route::get('/products/{slug}',[HomeController::class,'productDetail'])->name('home.detail');
Route::get('/author/{author}',[HomeController::class,'searchByAuthor'])->name('home.author');
Route::get('/category/{category}',[HomeController::class,'searchByCategory'])->name('home.category');
Route::get('/filter',[HomeController::class,'searchByFilter'])->name('home.filter');
//Tìm kiếm sản phẩm theo collection slug
Route::get('/collection/{collection}',[HomeController::class,'searchByCollection'])->name('home.collection');
//Lấy ra danh sách sản phẩm có collection
Route::get('/collection',[HomeController::class,'getAllCollection'])->name('home.get-collection');
Route::get('/hot-deal',[HomeController::class,'getHotDeal'])->name('home.get-hot-deal');
//Article route
Route::get('/articles',[HomeController::class,'getArticles'])->name('home.articles.index');
Route::get('/articles/{slug}',[HomeController::class,'articleDetail'])->name('home.articles.detail');

require __DIR__.'/auth.php';
