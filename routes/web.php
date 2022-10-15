<?php

use App\Http\Controllers\Home\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

Route::get('/products/search}',[HomeController::class,'searchProducts'])->name('home.search');
//Route::get('/products/{slug?}',[HomeController::class,'searchProducts'])->name('home.search');

//Route::get('/articles', [ArticleController::class, 'index']);
//
//Route::get('/articles/create', [ArticleController::class,'create'])->name('article.create');
//
//Route::post('/articles/create', [ArticleController::class,'store'])->name('article.store');
