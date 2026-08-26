<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CatController;
use App\Http\Controllers\CatReservationController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// CAT
Route::resource('/cats', CatController::class);

// PRODUCT
Route::resource('/products', ProductController::class);

// CAT RESERVATION
Route::resource('/cat_reservations', CatReservationController::class);

// CART
Route::get('/carts', [App\Http\Controllers\CartController::class, 'index'])->name('carts.index');
Route::post('/carts', [App\Http\Controllers\CartController::class, 'store'])->name('carts.store');
Route::put('/carts/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('carts.update');
Route::delete('/carts/{id}', [App\Http\Controllers\CartController::class, 'delete'])->name('carts.delete');
