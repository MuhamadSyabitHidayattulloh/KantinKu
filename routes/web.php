<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\VendorController as AdminVendorController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Vendor\DashboardController as VendorDashboardController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\OrderController as VendorOrderController;
use App\Http\Controllers\Vendor\ReportController as VendorReportController;
use App\Http\Controllers\User\ExploreController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\WalletController;

// Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Guest Routes (Auth Pages)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    // Route::get('/register', function () {
    //     return view('auth.register');
    // })->name('register');

    Route::get('/register', function () {
        abort(503, 'Registrasi ditutup sementara. Silakan hubungi admin untuk informasi lebih lanjut.');
    })->name('register');

    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('/users', AdminUserController::class);

        Route::resource('/vendors', AdminVendorController::class);

        Route::resource('/categories', AdminCategoryController::class);

        Route::resource('/transactions', TransactionController::class)->only(['index']);
        Route::post('/transactions/topup', [TransactionController::class, 'topup'])->name('transactions.topup');
        Route::post('/transactions/withdraw', [TransactionController::class, 'withdraw'])->name('transactions.withdraw');
        Route::post('/transactions/{transaction}/approve', [TransactionController::class, 'approve'])->name('transactions.approve');
        Route::post('/transactions/{transaction}/reject', [TransactionController::class, 'reject'])->name('transactions.reject');

        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports');
        Route::get('/reports/export', [AdminReportController::class, 'export'])->name('reports.export');
    });

    // Vendor Routes
    Route::prefix('vendor')->name('vendor.')->middleware('role:vendor')->group(function () {
        Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');

        Route::resource('/products', ProductController::class);

        Route::resource('/orders', VendorOrderController::class)->only(['index']);
        Route::post('/order-details/{detail}/status', [VendorOrderController::class, 'updateDetailStatus'])->name('orderDetails.updateStatus');

        Route::get('/reports', [VendorReportController::class, 'index'])->name('reports');
        Route::get('/reports/export', [VendorReportController::class, 'export'])->name('reports.export');
    });

    // User Routes
    Route::prefix('user')->name('user.')->middleware('role:user')->group(function () {
        Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
        Route::get('/explore/{product}', [ExploreController::class, 'show'])->name('product.show');

        Route::get('/cart', [CartController::class, 'index'])->name('cart');
        Route::post('/cart/{product}/add', [CartController::class, 'add'])->name('cart.add');
        Route::post('/cart/{product}/update', [CartController::class, 'update'])->name('cart.update');
        Route::post('/cart/{product}/remove', [CartController::class, 'remove'])->name('cart.remove');
        Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

        Route::resource('/orders', UserOrderController::class)->only(['index', 'show']);
        Route::post('/orders/{order}/cancel', [UserOrderController::class, 'cancel'])->name('orders.cancel');

        Route::get('/wallet', [WalletController::class, 'show'])->name('wallet');
        Route::get('/wallet/topup', [WalletController::class, 'topup'])->name('wallet.topup');
        Route::post('/wallet/topup', [WalletController::class, 'topupStore'])->name('wallet.topup.store');
        Route::get('/wallet/withdraw', [WalletController::class, 'withdraw'])->name('wallet.withdraw');
        Route::post('/wallet/withdraw', [WalletController::class, 'withdrawStore'])->name('wallet.withdraw.store');
    });
});
