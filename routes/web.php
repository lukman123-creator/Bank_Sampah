<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

 

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('landing'); // Ganti ke landing.blade.php nantinya
});

// Route Google OAuth
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

// Route untuk User Biasa (Hanya bisa diakses kalau sudah login)
Route::middleware(['auth', 'verified'])->group(function () {
    // Akan diisi oleh Pekerja C
});

// Route khusus Admin (Hanya bisa diakses admin)
Route::middleware(['auth', 'is_admin'])->group(function () {
    // Akan diisi oleh Pekerja D
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
