<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopCartController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home
Route::redirect('/', '/login');

// Cards
Route::controller(CardController::class)->group(function () {
    Route::get('/cards', 'list')->name('cards');
    Route::get('/cards/{id}', 'show');
});


// API
Route::controller(CardController::class)->group(function () {
    Route::put('/api/cards', 'create');
    Route::delete('/api/cards/{card_id}', 'delete');
});

Route::controller(ItemController::class)->group(function () {
    Route::put('/api/cards/{card_id}', 'create');
    Route::post('/api/item/{id}', 'update');
    Route::delete('/api/item/{id}', 'delete');
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