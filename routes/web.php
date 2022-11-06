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
Route::get('/filter',[HomeController::class,'searchByFilter'])->name('home.filter');
Route::get('/collection/{collection}',[HomeController::class,'searchByCollection'])->name('home.collection');

Route::get('/user', function () {
    dd(Auth::user());
    return view('user');
})->middleware(['auth'])->name('dashboard');

//Route::get('/articles', [ArticleController::class, 'index']);
//
//Route::get('/articles/create', [ArticleController::class,'create'])->name('article.create');
//
//Route::post('/articles/create', [ArticleController::class,'store'])->name('article.store');

require __DIR__.'/auth.php';
