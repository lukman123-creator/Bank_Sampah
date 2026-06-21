<?php

use App\Http\Controllers\AdminAnalyticsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// 1. Route Public (Tanpa Login)
Route::get('/', function () {
    return view('landing'); 
});

// Route Google OAuth
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('login.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);


// 2. Route untuk User Biasa (Hanya bisa diakses kalau sudah login & terverifikasi)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Fitur Transaksi & Booking Setor Sampah Warga
    Route::get('/transaksi', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transaksi', [TransactionController::class, 'store'])->name('transactions.store');
    
    // Fitur Penukaran Hadiah / Booking OTP Warga
    Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
    Route::post('/katalog/tukar', [KatalogController::class, 'tukar'])->name('katalog.tukar');
    Route::post('/transactions/redeem', [TransactionController::class, 'redeemReward'])->name('transactions.redeem');
    Route::post('/katalog/withdraw', [KatalogController::class, 'withdrawBank'])->name('katalog.withdraw');
    
    Route::view('/panduan', 'panduan')->name('panduan');
});


// 3. Route Khusus Admin (Hanya bisa diakses akun Admin dengan prefix /admin)
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/analytics', [AdminAnalyticsController::class, 'index'])->name('analytics');
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users.index');
    
    // 👇 TAMBAHIN BARIS INI BUAT HALAMAN KELOLA TRANSAKSI ADMIN 👇
    Route::get('/transactions', [App\Http\Controllers\AdminController::class, 'transactionsIndex'])->name('transactions.index');
    
    // Logika Baru: Verifikasi Fisik oleh Admin di Lokasi
    Route::post('/transactions/{id}/approve-deposit', [AdminController::class, 'approveDeposit'])->name('transactions.approve_deposit');
    Route::post('/transactions/{id}/approve-redeem', [AdminController::class, 'approveRedeem'])->name('transactions.approve_redeem');
    
    // Route bawaan lama
    Route::patch('/transactions/{id}/approve', [AdminController::class, 'approveTransaction'])->name('transactions.approve');

    // CRUD Master Data Rewards & Waste Types
    Route::resource('rewards', RewardController::class)->except(['create', 'show', 'edit']);
    Route::resource('waste-types', App\Http\Controllers\Admin\WasteTypeController::class)->except(['create', 'show', 'edit']);
    
    // Fitur Approve/Reject Tarik Tunai
    Route::post('/transactions/{transaction}/approve-withdrawal', [App\Http\Controllers\AdminController::class, 'approveWithdrawal'])->name('transactions.approve-withdrawal');
    Route::post('/transactions/{transaction}/reject-withdrawal', [App\Http\Controllers\AdminController::class, 'rejectWithdrawal'])->name('transactions.reject-withdrawal');

    // FITUR BARU: JUAL KE PENGEPUL
    Route::get('/stocks', [App\Http\Controllers\AdminController::class, 'stocksIndex'])->name('stocks.index');
    Route::get('/sales', [App\Http\Controllers\AdminController::class, 'salesIndex'])->name('sales.index');
    Route::post('/transactions/sell-to-collector', [AdminController::class, 'sellToCollector'])->name('transactions.sell-to-collector');
});


// 4. Route Kelola Akun Profile (Bawaan Laravel Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';