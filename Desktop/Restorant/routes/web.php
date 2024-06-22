<?php

use App\Http\Controllers\Admin\CategoryCotroller;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('users', UserController::class)->names('admin.users')->except(['show']);
    Route::resource('categories', CategoryCotroller::class)->names('admin.categories')->except(['show']);
    Route::resource('sub-categories', SubcategoryController::class)->names('admin.sub-categories')->except(['show']);
    Route::resource('foods', FoodController::class)->names('admin.foods')->except(['show']);
    Route::resource('tables', TableController::class)->names('admin.tables')->except(['show']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


Auth::routes();

