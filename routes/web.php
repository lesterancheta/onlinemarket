<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Main shop route
Route::get('/', [ShopController::class, 'index'])->name('shop');

// Ordering route (only for authenticated customers)
Route::middleware(['auth', 'role:customer'])->group(function () {

    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Admin routes (accessible only for admins)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/products/manage', [AdminController::class, 'manageProducts'])->name('products.manage');
    Route::resource('products', ProductController::class);
    Route::get('/vendors', [AdminController::class, 'viewVendors'])->name('vendors');
});

// Vendor routes (accessible only for vendors)
Route::middleware(['auth', 'role:vendor'])
    ->prefix('vendor')
    ->name('vendor.')
    ->group(function () {
        Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
        Route::get('/products', [VendorController::class, 'products'])->name('products');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');

        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        Route::get('/orders', [VendorController::class, 'orders'])->name('orders'); // ✅ This defines 'vendor.orders'
    });
// Vendor registration route
Route::get('/register/vendor', [RegisterController::class, 'showVendorRegisterForm'])->name('register.vendor');
Route::post('/register/vendor', [RegisterController::class, 'registerVendor']);
Route::post('/vendor/register', [VendorController::class, 'register'])->name('vendor.register.submit');
//customer
Route::middleware(['auth', 'role:customer'])->get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');

//view ng order
Route::middleware('auth')->group(function () {
    Route::post('/order/{productId}', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/orders', [OrderController::class, 'viewOrders'])->name('orders.view');
    // routes/web.php
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/single', [CheckoutController::class, 'checkoutSingle'])->name('checkout.single');

});

Route::put('/orders/{order}', [VendorController::class, 'updateOrderStatus'])->name('orders.update');
Route::middleware(['auth', 'role:vendor'])
    ->prefix('vendor')
    ->name('vendor.')
    ->group(function () {
        Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
        Route::get('/products', [VendorController::class, 'products'])->name('products');
        Route::get('/orders', [VendorController::class, 'orders'])->name('orders');

        // ✅ Add this line
        Route::put('/orders/{order}', [VendorController::class, 'updateOrder'])->name('orders.update');
    });

    Route::put('/vendor/orders/{order}/update', [VendorController::class, 'updateOrder'])->name('vendor.orders.update');
Route::get('/admin/customers', [AdminController::class, 'viewCustomers'])->name('admin.customers');
Route::get('/admin/orders', [AdminController::class, 'viewOrders'])->name('admin.orders');
    //delivery
 Route::middleware(['auth', 'role:delivery'])->prefix('delivery')->name('delivery.')->group(function () {
    Route::get('/dashboard', [DeliveryController::class, 'dashboard'])->name('dashboard');
    Route::put('/orders/{order}/status', [DeliveryController::class, 'updateStatus'])->name('orders.updateStatus');
 
});
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
   Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/update-all', [CartController::class, 'updateAll'])->name('cart.update.all');
Route::post('/cart/checkout-multiple', [CartController::class, 'checkoutMultiple'])->name('checkout.multiple');

});


// Logout fallback route (can be removed if handled by LoginController)
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout');
