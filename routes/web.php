<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Products
Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
Route::get('/produk/{id}', [ProductController::class, 'show'])->name('products.show');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');

// Brosur
Route::get('/brosur', function () {
    return view('brosur.index');
})->name('brosur');

// Cart & Checkout (Protected Routes)
Route::middleware(['auth'])->group(function () {
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/tambah/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/keranjang/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/keranjang/hapus/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    
    // Checkout
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('checkout.process');
    
    // Profile Routes
    Route::get('/profil', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profil/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    
    // Password Routes
    Route::get('/profil/password', [ProfileController::class, 'showChangePassword'])->name('profile.password');
    Route::patch('/profil/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    
    // Address Routes
    Route::get('/profil/alamat', [ProfileController::class, 'addresses'])->name('profile.addresses');
    Route::get('/profil/alamat/tambah', [ProfileController::class, 'createAddress'])->name('profile.addresses.create');
    Route::post('/profil/alamat', [ProfileController::class, 'storeAddress'])->name('profile.addresses.store');
    Route::get('/profil/alamat/{id}/edit', [ProfileController::class, 'editAddress'])->name('profile.addresses.edit');
    Route::patch('/profil/alamat/{id}', [ProfileController::class, 'updateAddress'])->name('profile.addresses.update');
    Route::delete('/profil/alamat/{id}', [ProfileController::class, 'destroyAddress'])->name('profile.addresses.destroy');
    Route::patch('/profil/alamat/{id}/utama', [ProfileController::class, 'setPrimaryAddress'])->name('profile.addresses.primary');
});

