<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\KeyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopCartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PasswordRecoveryController;

// Home
Route::get('/', [ProductController::class, 'index'])->name('home');

// Authentication
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'authenticate')->name('login-action');
    Route::get('/logout', 'logout')->name('logout');
});

// Reset Password

// Route to show the password reset form
Route::get('/password-reset', function () {
    return view('password-reset'); 
})->name('password-reset-form');

// Route to handle the form submission and send the recovery link
Route::post('/password-reset', [PasswordRecoveryController::class, 'sendRecoveryLink'])
    ->name('password-reset');

// Route to display the password reset form after clicking the email link
Route::get('/password/reset', [PasswordRecoveryController::class, 'showResetForm'])
    ->name('password.reset');

// Route to handle updating the password
Route::post('/password/update', [PasswordRecoveryController::class, 'updatePassword'])
    ->name('password.update');

// Registration
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register')->name('register-action');
});

// Products
Route::controller(ProductController::class)->group(function () {
    Route::get('/product/{id}', 'show')->name('product');
    Route::get('/product/{id}/edit', 'edit')->name('product.edit');
    Route::post('/product/{id}/edit', 'update')->name('product.update');
    Route::post('/search', 'search')->name('search');
    Route::get('/search', 'display')->name('display_search');
});

// Protected Routes
Route::middleware('auth')->group(function () {
    // User Management
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'manage')->name('management');
        // Profile Page Routes
        Route::get('/profile/{id}', 'show')->name('profile.show');
        Route::get('/profile/{id}/edit', 'edit')->name('profile.edit');
        Route::put('/profile/{id}/edit', 'update')->name('profile.update');
        Route::delete('/profile/{id}', 'destroy')->name('profile.destroy');
        Route::get('/profile', function () {
            return redirect()->route('profile.show', ['id' => Auth::id()]);
        })->name('profile.redirect');
    });

    // Shopping Cart
    Route::controller(ShopCartController::class)->group(function () {
        Route::get('/cart', 'show')->name('cart.show');
        Route::post('/cart', 'store')->name('cart.store');
        Route::put('/cart', 'update')->name('cart.update');
        Route::delete('/cart', 'destroy')->name('cart.destroy');
    });

    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist/{id}', 'show')->name('wishlist.show');
        Route::post('/wishlist', 'store')->name('wishlist.store');
        Route::delete('/wishlist', 'destroy')->name('wishlist.destroy');
    });

    // Orders
    Route::controller(OrderController::class)->group(function () {
        Route::get('/checkout', 'create')->name('checkout');
        Route::post('/checkout', 'store')->name('checkout.action');
        Route::get('/orders/{id}', 'listUserOrders')->name('order.history');
        Route::get('/orders/{user_id}/{order_id}', 'show')->name('order.details');
    });

    // Keys
    Route::controller(KeyController::class)->group(function () {
        Route::get('/keys/{id}', 'list')->name('key.inventory');
        Route::get('/keys', function () {
            return redirect()->route('key.inventory', ['id' => Auth::id()]);
        })->name('keys.redirect');
    });
});

// About Us
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// FAQ
Route::get('/faq', function () {
    return view('pages.faq');
})->name('faq');

// contact
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

// Fallback
Route::fallback(function () {
    return response()->view('pages.error', ['errorCode' => '404'], 404);
});
