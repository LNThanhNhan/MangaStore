<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',function(){
    return view('layout.master');
});

//Route::get('/articles', [ArticleController::class, 'index']);
//
//Route::get('/articles/create', [ArticleController::class,'create'])->name('article.create');
//
//Route::post('/articles/create', [ArticleController::class,'store'])->name('article.store');
