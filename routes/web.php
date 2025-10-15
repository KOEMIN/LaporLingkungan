<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController; // Diimpor di sini

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Inilah "peta jalan" untuk website Anda.
*/

// Rute untuk halaman utama, sekarang HANYA ADA SATU dan sudah benar.
// Bisa diakses oleh siapa saja.
Route::get('/', [LaporanController::class, 'index'])->name('home');

// Semua rute yang memerlukan login kita kelompokkan di sini.
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Rute untuk dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Rute untuk profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk Laporan (Create, Store, Show, Edit, Update, Destroy)
    // Rute resource ini juga memerlukan login
    Route::resource('laporan', LaporanController::class);
});

// Rute untuk otentikasi (login, register, dll) dimuat dari file terpisah.
require __DIR__.'/auth.php';