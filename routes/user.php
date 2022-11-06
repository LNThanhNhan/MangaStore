<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'profile'])->name('profile.info');
Route::post('/', [UserController::class, 'update'])->name('profile.update');
