<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransaksiController;

// Rute untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Rute resource untuk MobilController
Route::resource('mobils', MobilController::class)->middleware('auth'); // Menambahkan middleware auth

// Rute untuk dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth'); // Menambahkan middleware auth

// Rute untuk pemesanan dengan middleware auth
Route::middleware(['auth'])->group(function () {
    Route::get('/pemesanans/create', [PemesananController::class, 'create'])->name('pemesanans.create');
    Route::post('/pemesan', [PemesananController::class, 'store'])->name('pemesan.store');
    Route::get('/pemesan', [PemesananController::class, 'index'])->name('pemesan.index');
    Route::post('/pemesan/{id}/status', [PemesananController::class, 'updateStatus'])->name('pemesan.updateStatus');
    Route::get('/pemesan/{id}/edit', [PemesananController::class, 'edit'])->name('pemesanans.edit'); // Rute untuk edit pemesanan
    Route::put('/pemesan/{id}', [PemesananController::class, 'update'])->name('pemesan.update'); // Rute untuk update pemesanan
    Route::delete('/pemesan/{id}', [PemesananController::class, 'destroy'])->name('pemesanans.destroy'); // Rute untuk delete pemesanan
    Route::get('/pemesanans/{id}', [PemesananController::class, 'detail'])->name('pemesanans.detail');
    Route::resource('pemesanans', PemesananController::class);
});

// Rute untuk login dan logout
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rute untuk pendaftaran
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Rute resource untuk CustomerController
Route::resource('customers', CustomerController::class)->middleware('auth'); // Menambahkan middleware auth
Route::resource('transaksis', TransaksiController::class);