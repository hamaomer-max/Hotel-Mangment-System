<?php

use App\Http\Controllers\Admin\CategoryCotroller;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Chef\FoodController as ChefFoodController;
use App\Http\Controllers\Chef\OrderController;
use App\Http\Controllers\Server\FoodController as ServerFoodController;
use App\Http\Controllers\Server\TableController as ServerTableController;
use App\Models\Ressrevation;
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
    Route::resource('ressrevations', ReservationController::class)->names('admin.ressrevations')->except(['index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::prefix('server')->middleware('auth')->group(function () {
    Route::get('/home', [ServerTableController::class, 'index'])->name('server.home');
    Route::get('/foods/{id}', [ServerFoodController::class, 'index'])->name('server.food');
    Route::post('/foods-store', [ServerFoodController::class, 'store'])->name('server.foods.store');
    Route::post('/plus-or-minus/{id}/{value}', [ServerFoodController::class, 'plus_or_minus'])->name('server.foods.plus_or_minus');
    Route::post('/invoice-delete/{id}', [ServerTableController::class, 'destroy'])->name('server.delete');
    Route::post('/order-delete/{id}', [ServerTableController::class, 'delete_orders'])->name('server.delete_orders');
});

Route::prefix('chef')->middleware('auth')->group(function () {
    Route::get('/home',[ChefFoodController::class, 'index'])->name('chef.home');
    Route::get('/order-home',[OrderController::class, 'index'])->name('order.home');
    Route::post('/foods-update-status/{id}/{status}', [OrderController::class, 'update_status'])->name('chef.update_status');
    Route::post('/foods-available/{id}', [ChefFoodController::class, 'available'])->name('chef.available');
});



Auth::routes();
