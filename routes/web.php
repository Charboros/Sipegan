<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'dashboard'])->name('public.dashboard');
Route::get('/daftar/magang', [PublicController::class, 'daftarMagang'])->name('public.daftar_magang');
Route::post('/daftar/magang', [PublicController::class, 'storeMagang'])->name('public.store_magang');
Route::get('/daftar/penelitian', [PublicController::class, 'daftarPenelitian'])->name('public.daftar_penelitian');
Route::post('/daftar/penelitian', [PublicController::class, 'storePenelitian'])->name('public.store_penelitian');
Route::get('/cek-status', [PublicController::class, 'cekStatus'])->name('public.cek_status');
Route::post('/cek-status', [PublicController::class, 'searchStatus'])->name('public.search_status');
Route::get('/faq', [PublicController::class, 'faq'])->name('public.faq');

use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\QuotaController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\UserController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [RegistrationController::class, 'dashboard'])->name('dashboard');

    // FAQ Management (Petugas & Admin)
    Route::resource('faqs', FaqController::class)->except(['show', 'create', 'edit']);

    // Data Pendaftaran (Petugas & Admin)
    Route::get('/registrations', [RegistrationController::class, 'index'])->name('admin.registrations.index');
    Route::get('/registrations/{registration}', [RegistrationController::class, 'show'])->name('admin.registrations.show');
    Route::patch('/registrations/{registration}/status', [RegistrationController::class, 'updateStatus'])->name('admin.registrations.status');
    Route::delete('/registrations/{registration}', [RegistrationController::class, 'destroy'])->name('admin.registrations.destroy');

    // Konfigurasi Kuota (Petugas & Admin)
    Route::get('/quotas', [QuotaController::class, 'index'])->name('quotas.index');
    Route::post('/quotas', [QuotaController::class, 'store'])->name('quotas.store');
    Route::patch('/quotas/{quota}', [QuotaController::class, 'update'])->name('quotas.update');
    Route::delete('/quotas/{quota}', [QuotaController::class, 'destroy'])->name('quotas.destroy');

    // Konfigurasi Users (Admin Only)
    Route::get('/users', [UserController::class, 'index'])->name('konfigurasi.index')->middleware('can:admin');
    Route::post('/users', [UserController::class, 'store'])->name('konfigurasi.store')->middleware('can:admin');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('konfigurasi.update')->middleware('can:admin');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('konfigurasi.destroy')->middleware('can:admin');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
