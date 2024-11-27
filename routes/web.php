<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\KeyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopCartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Home
Route::get('/', function () {
    return Auth::check() ? redirect('/profile/' . Auth::id()) : redirect('/login');
});

// Authentication
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'authenticate')->name('login-action');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register')->name('register-action');
});

// Protected Routes
Route::middleware('auth')->group(function () {
    // User Management
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'manage')->name('management');
        Route::get('/profile/{id}', 'show')->name('profile.show');
        Route::get('/profile/{id}/edit', 'edit')->name('profile.edit');
        Route::post('/profile/{id}', 'update')->name('profile.update');
        Route::delete('/profile/{id}', 'destroy')->name('profile.destroy');
    });

    // Orders
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders/{id}', 'listUserOrders')->name('order.history');
        Route::get('/orders/{user_id}/{order_id}', 'details')->name('order.details');
    });

    // Keys
    Route::controller(KeyController::class)->group(function () {
        Route::get('/keys/{id}', 'list')->name('key.inventory');
    });

    // Products
    Route::controller(ProductController::class)->group(function () {
        Route::get('/product/{id}', 'show')->name('product');
        Route::post('/search', 'search')->name('search');
        Route::get('/search', 'display')->name('display_search');
    });
});
// Products
Route::controller(ProductController::class)->group(function () {
    Route::get('/products/{id}', 'show')->name('products.show'); // Add name to route
});
// Shopping Cart Routes
Route::controller(ShopCartController::class)->group(function () {
    Route::get('/cart', 'index')->name('cart.index');
    Route::patch('/cart/{product}', 'update')->name('cart.update');
    Route::delete('/cart/{product}', 'remove')->name('cart.remove');
    Route::post('/cart/add/{product}', 'addToCart')->name('cart.add');
});
//Route::post('/cart/add/{product}', [ShopCartController::class, 'addToCart'])->name('cart.add')->middleware('auth');
// Checkout Routes
Route::controller(CheckoutController::class)->group(function () {
    Route::get('/checkout', 'show')->name('checkout.show');
    Route::post('/checkout/process', 'process')->name('checkout.process');
});
