<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::view('login', 'auth.login')->name('auth.login');
Route::view('register', 'auth.register')->name('auth.register');
Route::view('dashboard', 'admin.dashboard')->name('admin.dashboard');

Route::view('cart', 'cart')->name('user.cart');

Route::post('/order', [OrderController::class, 'store'])->name('create.order');

// Route::view('checkout', 'checkout.form')->name('user.checkout');

Route::get('/checkout', [OrderController::class, 'index'])->name('user.checkout');

//cart
Route::post('/cart/{productId}', [CartController::class, 'store'])->name('cart.create');
Route::post('/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'destroy'])->name('cart.destroy');

//order
Route::get('/order', [OrderController::class, 'store'])->name('order.create');
Route::get('/order-list', [OrderProductController::class, 'index'])->name('order.list');

Route::view('createproduct', 'admin.createproduct')->name('admin.dashboard.create.product');
Route::post('/createproduct', [ProductController::class, 'store'])->name('create.product');

Route::post('/search', [ProductController::class, 'search'])->name('product.search');

Route::get('/', [ProductController::class, 'index'])->name('public.home');

Route::post('/register', [UserController::class, 'store'])->name('auth.register.create');
Route::post('/login', [LoginController::class, 'auth'])->name('auth.login.create');
Route::get('/logout', [LoginController::class, 'logout'])->name('auth.login.logout');
