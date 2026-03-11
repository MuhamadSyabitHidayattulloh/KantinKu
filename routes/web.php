<?php

use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/users', function () {
        return view('admin.users');
    })->name('users');

    Route::get('/vendors', function () {
        return view('admin.vendors');
    })->name('vendors');

    Route::get('/transactions', function () {
        return view('admin.transactions');
    })->name('transactions');

    Route::get('/reports', function () {
        return view('admin.reports');
    })->name('reports');
});

// Vendor Routes
Route::prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/dashboard', function () {
        return view('vendor.dashboard');
    })->name('dashboard');

    Route::get('/products', function () {
        return view('vendor.products');
    })->name('products');

    Route::get('/orders', function () {
        return view('vendor.orders');
    })->name('orders');

    Route::get('/reports', function () {
        return view('vendor.reports');
    })->name('reports');
});

// User Routes
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/explore', function () {
        return view('user.explore');
    })->name('explore');

    Route::get('/cart', function () {
        return view('user.cart');
    })->name('cart');

    Route::get('/orders', function () {
        return view('user.orders');
    })->name('orders');
});
