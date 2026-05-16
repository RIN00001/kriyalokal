<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SellerApplicationController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Seller\ProductController as SellerProductController;
use App\Http\Controllers\CheckoutController;

Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])
    ->name('google.callback');

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/become-seller', [SellerApplicationController::class, 'create'])
        ->name('seller-applications.create');

    Route::post('/become-seller', [SellerApplicationController::class, 'store'])
        ->name('seller-applications.store');
});

Route::middleware(['auth', 'role:seller'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {
        Route::resource('products', SellerProductController::class);
        Route::patch('/products/{product}/toggle', [SellerProductController::class, 'toggle'])
            ->name('products.toggle');
    });

use App\Http\Controllers\CartController;

Route::middleware(['auth', 'role:customer,seller'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/{product}', [CartController::class, 'store'])
        ->name('cart.store');

    Route::patch('/cart/items/{cartItem}', [CartController::class, 'update'])
        ->name('cart.items.update');

    Route::delete('/cart/items/{cartItem}', [CartController::class, 'destroy'])
        ->name('cart.items.destroy');
});



Route::middleware(['auth', 'role:customer,seller'])->group(function () {
    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');
});

use App\Http\Controllers\OrderController;

Route::middleware(['auth', 'role:customer,seller'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show');

    Route::patch('/orders/{order}/refund', [OrderController::class, 'requestRefund'])
        ->name('orders.refund');

    Route::patch('/orders/{order}/success', [OrderController::class, 'markSuccess'])
        ->name('orders.success');
});

use App\Http\Controllers\Seller\OrderController as SellerOrderController;

Route::middleware(['auth', 'role:seller'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {
        Route::get('/orders', [SellerOrderController::class, 'index'])
            ->name('orders.index');

        Route::patch('/orders/items/{orderItem}/accept', [SellerOrderController::class, 'accept'])
            ->name('orders.items.accept');

        Route::patch('/orders/items/{orderItem}/reject', [SellerOrderController::class, 'reject'])
            ->name('orders.items.reject');
    });

require __DIR__.'/auth.php';
