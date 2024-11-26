<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopCartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\KeyController;
use App\Http\Controllers\ShopCartController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Home
Route::get('/', function () {
    return Auth::check() ? redirect('/profile/' . Auth::id()) : redirect('/login');
});

// Authentication

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

//Profile
Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'show')->name('profile');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products/{id}', 'show');
});

// Shopping Cart Routes
Route::controller(ShopCartController::class)->group(function () {
    Route::get('/cart', 'index')->name('cart.index');
    Route::patch('/cart/{product}', 'update')->name('cart.update');
    Route::delete('/cart/{product}', 'remove')->name('cart.remove');
    Route::post('/cart/add/{product}', 'addToCart')->name('cart.add'); 
});
//Route::post('/cart/add/{product}', [ShopCartController::class, 'addToCart'])->name('cart.add')->middleware('auth');