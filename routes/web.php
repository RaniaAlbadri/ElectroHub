<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

// PUBLIC STOREFRONT
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product:slug}', [ShopController::class, 'show'])->name('shop.show');


// SHOPPING CART — LOGIN REQUIRED

Route::get('/cart', [CartController::class, 'index'])
    ->middleware('auth')->name('cart.index');

Route::post('/cart/add/{product}', [CartController::class, 'add'])
    ->middleware('auth')->name('cart.add');

Route::post('/cart/update/{product}', [CartController::class, 'update'])
    ->middleware('auth')->name('cart.update');

Route::post('/cart/remove/{product}', [CartController::class, 'remove'])
    ->middleware('auth')->name('cart.remove');


// CHECKOUT — LOGIN REQUIRED

Route::get('/checkout', [CheckoutController::class, 'create'])
    ->middleware('auth')->name('checkout.create');

Route::post('/checkout', [CheckoutController::class, 'store'])
    ->middleware('auth')->name('checkout.store');

Route::get('/checkout/success', [CheckoutController::class, 'success'])
    ->middleware('auth')->name('checkout.success');


// BREEZE AUTHENTICATED PAGES
Route::get('/dashboard', fn () => redirect()->route('home'))
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/my-orders', [OrderHistoryController::class, 'index'])->name('orders.index');
    Route::get('/my-orders/{order}', [OrderHistoryController::class, 'show'])->name('orders.show');

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('/wishlist/ids', [WishlistController::class, 'ids'])->name('wishlist.ids');
    Route::post('/wishlist/import', [WishlistController::class, 'import'])->name('wishlist.import');
    Route::post('/wishlist/toggle/{product}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::delete('/wishlist/{product}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});

// ADMIN ROUTES -- original AdminController with Brands added

Route::middleware(['auth','can:manage-store',\App\Http\Middleware\RecordAdminActivity::class,])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        // Categories
        Route::get('/categories', [AdminController::class, 'categories'])->name('categories.index');
        Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
        Route::match(['put', 'patch'], '/categories/{category}', [AdminController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/categories/{category}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');

        // Products
        Route::get('/products', [AdminController::class, 'products'])->name('products.index');
        Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
        Route::match(['put', 'patch'], '/products/{product}', [AdminController::class, 'updateProduct'])->name('products.update');
        Route::delete('/products/{product}', [AdminController::class, 'destroyProduct'])->name('products.destroy');

        // Orders
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index');
        Route::get('/orders/{order}', [AdminController::class, 'showOrder'])->name('orders.show');
        Route::match(['put', 'patch'], '/orders/{order}', [AdminController::class, 'updateOrder'])->name('orders.update');

        // Wishlist analytics for admin (customer wishlists stay above)
        Route::get('/wishlists', [AdminController::class, 'wishlists'])->name('wishlists.index');

        // Brands
        Route::get('/brands', [AdminController::class, 'brands'])->name('brands.index');
        Route::post('/brands', [AdminController::class, 'storeBrand'])->name('brands.store');
        Route::match(['put', 'patch'], '/brands/{brand}', [AdminController::class, 'updateBrand'])->name('brands.update');
        Route::delete('/brands/{brand}', [AdminController::class, 'destroyBrand'])->name('brands.destroy');

        Route::delete('/categories/bulk/delete', [AdminController::class, 'bulkDeleteCategories'])->name('categories.bulk-delete');
        Route::delete('/products/bulk/delete', [ AdminController::class, 'bulkDeleteProducts'])->name('products.bulk-delete');
        Route::delete('/brands/bulk/delete', [AdminController::class, 'bulkDeleteBrands'])->name('brands.bulk-delete');
        Route::delete('/orders/bulk/delete', [AdminController::class, 'bulkDeleteOrders'])->name('orders.bulk-delete');

        Route::get('/admins', [AdminController::class, 'admins'])->name('admins.index');
        Route::patch('/admins/{user}/promote', [AdminController::class, 'promoteAdmin'])->middleware('throttle:6,1')->name('admins.promote');
        
        Route::patch('/admins/{user}/revoke',[AdminController::class, 'revokeAdmin'])->middleware('throttle:6,1')->name('admins.revoke');

        Route::get('/activity-logs',[AdminController::class, 'activityLogs'])->name('activity-logs.index');
        
        });

// BREEZE LOGIN / REGISTER / PASSWORD RESET
require __DIR__ . '/auth.php';
