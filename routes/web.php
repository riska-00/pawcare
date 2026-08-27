<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CatReservationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShipmentController;
use Pest\Plugins\Profile;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// CAT
Route::get('/cats', [CatController::class, 'index'])->name('cats.index');
Route::get('/cats/{cat}', [CatController::class, 'show'])->name('cats.show');

Route::middleware('auth')->group(function () {
    Route::get('/cats/create', [CatController::class, 'create'])->name('cats.create');
    Route::post('/cats', [CatController::class, 'store'])->name('cats.store');
    Route::get('/cats/{cat}/edit', [CatController::class, 'edit'])->name('cats.edit');
    Route::put('/cats/{cat}', [CatController::class, 'update'])->name('cats.update');
    Route::delete('/cats/{cat}', [CatController::class, 'destroy'])->name('cats.destroy');
});

// PRODUCT
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::middleware('auth')->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// CAT RESERVATION
Route::middleware('auth')->group(function () {
    Route::get('/cat_reservations', [CatReservationController::class, 'index'])->name('cat_reservations.index');
    Route::get('/cat_reservations/create', [CatReservationController::class, 'create'])->name('cat_reservations.create');
    Route::post('/cat_reservations', [CatReservationController::class, 'store'])->name('cat_reservations.store');
    Route::get('/cat_reservations/{id}', [CatReservationController::class, 'show'])->name('cat_reservations.show');
    Route::put('/cat_reservations/{id}', [CatReservationController::class, 'update'])->name('cat_reservations.update');
});

// CART
Route::middleware('auth')->group(function () {
    Route::get('/carts', [CartController::class, 'index'])->name('carts.index');
    Route::post('/carts', [CartController::class, 'store'])->name('carts.store');
    Route::put('/carts/{id}', [CartController::class, 'update'])->name('carts.update');
    Route::delete('/carts/{id}', [CartController::class, 'destroy'])->name('carts.delete');
});

// ORDER
Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});

// PAYMENT
Route::middleware('auth')->group(function () {
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');
    Route::put('/payments/{id}', [PaymentController::class, 'update'])->name('payments.update');
});

// SHIPMENT
Route::middleware('auth')->group(function () {
    Route::get('/shipments', [ShipmentController::class, 'index'])->name('shipments.index');
    Route::get('/shipments/{id}', [ShipmentController::class, 'show'])->name('shipments.show');
    Route::put('/shipments/{id}', [ShipmentController::class, 'update'])->name('shipments.update');
});

// FAVORITE
Route::middleware('auth')->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});