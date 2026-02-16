<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;

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

use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ShopController;

// Public Routes
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['ar', 'fr'])) {
        session()->put('locale', $locale);
    }
    return back();
})->name('lang.switch');

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{slug}', [PublicController::class, 'show'])->name('product.show');
Route::post('/order', [PublicController::class, 'storeOrder'])->middleware('throttle:5,1')->name('order.store');

// Static Pages
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');

// Parent Category Page
Route::get('/category/{slug}', [PublicController::class, 'parentCategory'])->name('category.parent');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->middleware('throttle:30,1')->name('cart.add');
Route::patch('/cart/update', [CartController::class, 'update'])->middleware('throttle:30,1')->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'remove'])->middleware('throttle:30,1')->name('cart.remove');

// Wishlist Routes
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->middleware('throttle:30,1')->name('wishlist.toggle');

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LoginController;

// Admin Auth Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});

// Redirect 'login' to 'admin.login' for auth middleware
Route::get('login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.products.index');
    });

    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}', [OrderController::class, 'updateStatus'])->name('orders.update');

    Route::get('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
    Route::post('settings/delete-about-image', [\App\Http\Controllers\Admin\SettingsController::class, 'deleteAboutImage'])->name('settings.delete-about-image');
    Route::post('partners', [\App\Http\Controllers\Admin\SettingsController::class, 'partnerStore'])->name('partners.store');
    Route::delete('partners/{partner}', [\App\Http\Controllers\Admin\SettingsController::class, 'partnerDestroy'])->name('partners.destroy');
});
