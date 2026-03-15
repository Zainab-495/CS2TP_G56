<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|-----------------------------------------------------------------------
| Public Pages
|-----------------------------------------------------------------------
*/
Route::get('/', fn() => view('home'))->name('home');
Route::get('/about', fn() => view('about'))->name('about');

/*
|-----------------------------------------------------------------------
| Dashboard (Breeze)
|-----------------------------------------------------------------------
*/
Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

/*
|-----------------------------------------------------------------------
| Category Pages
|-----------------------------------------------------------------------
*/
Route::get('/category/rings',     fn() => view('rings'))->name('category.rings');
Route::get('/category/earrings',  fn() => view('earrings'))->name('category.earrings');
Route::get('/category/bracelets', fn() => view('bracelets'))->name('category.bracelets');
Route::get('/category/necklaces', fn() => view('necklaces'))->name('category.necklaces');
Route::get('/category/watches',   fn() => view('watches'))->name('category.watches');

/*
|-----------------------------------------------------------------------
| Products
|-----------------------------------------------------------------------
*/
Route::get('/products', fn() => view('products'))->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

/*
|-----------------------------------------------------------------------
| Contact
|-----------------------------------------------------------------------
*/
Route::get('/contact',  [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

/*
|-----------------------------------------------------------------------
| Auth (custom JSON endpoints used by leila's JS)
|-----------------------------------------------------------------------
*/
Route::get('/login',    fn() => view('auth.login'))->name('login');
Route::get('/register', fn() => view('auth.register'))->name('register');

Route::post('/login-custom',    [AuthController::class, 'login'])->name('login-custom.post');
Route::post('/register-custom', [AuthController::class, 'register'])->name('register-custom.post');
Route::post('/logout',          [AuthController::class, 'logout'])->name('logout');

// JSON helpers for the JS frontend
Route::get('/auth/status',   [AuthController::class, 'status'])->name('auth.status');
Route::get('/session/init',  [AuthController::class, 'sessionInit'])->name('session.init');
Route::get('/login-custom',    [AuthController::class, 'showLogin'])->name('login-custom');
Route::get('/register-custom', [AuthController::class, 'showRegister'])->name('register-custom');

/*
|-----------------------------------------------------------------------
| Cart (session-based, JSON responses)
|-----------------------------------------------------------------------
*/
Route::get('/cart',              [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/data',         [CartController::class, 'data'])->name('cart.data');
Route::post('/cart/add',         [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update',      [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove',      [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear',       [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/place-order', [CartController::class, 'placeOrder'])->name('cart.placeOrder');

/*
|-----------------------------------------------------------------------
| Checkout
|-----------------------------------------------------------------------
*/
Route::get('/checkout',  [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

/*
|-----------------------------------------------------------------------
| Orders
|-----------------------------------------------------------------------
*/
Route::get('/orders',               [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}',          [OrderController::class, 'show'])->name('orders.show');
Route::post('/orders/{id}/cancel',  [OrderController::class, 'cancel'])->name('orders.cancel');
Route::post('/orders/{id}/refund',  [OrderController::class, 'refund'])->name('orders.refund');

/*
|-----------------------------------------------------------------------
| Admin
|-----------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});

/*
|-----------------------------------------------------------------------
| Profile (Breeze)
|-----------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
