<?php

use App\Http\Controllers\Admin\CategoryCotroller;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('users', UserController::class)->names('admin.users')->except(['show']);
    Route::resource('categories', CategoryCotroller::class)->names('admin.categories')->except(['show']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


Auth::routes();

