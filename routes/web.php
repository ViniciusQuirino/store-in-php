<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
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

Route::post('/cart/{productId}', [CartController::class,'store'])->name('cart.create');
Route::get('/cart', [CartController::class,'index'])->name('cart.index');
Route::delete('/cart/{productId}', [CartController::class,'destroy'])->name('cart.destroy');


Route::view('createproduct', 'admin.createproduct')->name('admin.dashboard.create.product');
Route::post('/createproduct', [ProductController::class, 'store'])->name('create.product');

Route::post('/search', [ProductController::class, 'search'])->name('product.search');

Route::get('/', [ProductController::class, 'index'])->name('public.home');

Route::post('/register', [UserController::class, 'store'])->name('auth.register.create');
Route::post('/login', [LoginController::class, 'auth'])->name('auth.login.create');
Route::get('/logout', [LoginController::class, 'logout'])->name('auth.login.logout');
