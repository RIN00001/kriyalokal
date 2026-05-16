<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductBrowseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerApplicationController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Seller\ProductController as SellerProductController;
use App\Http\Controllers\Seller\ReportController as SellerReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/partners', function () {
    return view('pages.partners');
})->name('partners');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

/*
|--------------------------------------------------------------------------
| Public Product Browsing
|--------------------------------------------------------------------------
*/

Route::get('/products', [ProductBrowseController::class, 'index'])
    ->name('products.index');

Route::get('/products/{product:slug}', [ProductBrowseController::class, 'show'])
    ->name('products.show');

/*
|--------------------------------------------------------------------------
| Google Authentication
|--------------------------------------------------------------------------
*/

Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])
    ->name('google.callback');

/*
|--------------------------------------------------------------------------
| Authenticated Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Customer + Seller Shared Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:customer,seller'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/{product}', [CartController::class, 'store'])
        ->name('cart.store');

    Route::patch('/cart/items/{cartItem}', [CartController::class, 'update'])
        ->name('cart.items.update');

    Route::delete('/cart/items/{cartItem}', [CartController::class, 'destroy'])
        ->name('cart.items.destroy');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show');

    Route::patch('/orders/{order}/refund', [OrderController::class, 'requestRefund'])
        ->name('orders.refund');

    Route::patch('/orders/{order}/success', [OrderController::class, 'markSuccess'])
        ->name('orders.success');
});

/*
|--------------------------------------------------------------------------
| Seller Application
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/become-seller', [SellerApplicationController::class, 'create'])
        ->name('seller-applications.create');

    Route::post('/become-seller', [SellerApplicationController::class, 'store'])
        ->name('seller-applications.store');
});

/*
|--------------------------------------------------------------------------
| Seller Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:seller'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('seller.dashboard');
        })->name('dashboard');

        Route::resource('products', SellerProductController::class);

        Route::patch('/products/{product}/toggle', [SellerProductController::class, 'toggle'])
            ->name('products.toggle');

        Route::get('/orders', [SellerOrderController::class, 'index'])
            ->name('orders.index');

        Route::patch('/orders/items/{orderItem}/accept', [SellerOrderController::class, 'accept'])
            ->name('orders.items.accept');

        Route::patch('/orders/items/{orderItem}/reject', [SellerOrderController::class, 'reject'])
            ->name('orders.items.reject');

        Route::get('/reports', [SellerReportController::class, 'index'])
            ->name('reports.index');

        Route::post('/reports/generate', [SellerReportController::class, 'generate'])
            ->name('reports.generate');

        Route::get('/reports/export', [SellerReportController::class, 'export'])
            ->name('reports.export');
    });

/*
|--------------------------------------------------------------------------
| Employee Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:employee'])
    ->prefix('employee')
    ->name('employee.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('employee.dashboard');
        })->name('dashboard');
    });

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });

/*
|--------------------------------------------------------------------------
| Breeze Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';