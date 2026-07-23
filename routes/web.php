<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\PortofolioController;
use App\Http\Controllers\Admin\KreatorController;

// PUBLIC
Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');

// AUTH
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// DASHBOARD (Protected)
Route::middleware(['auth'])->prefix('dashboard-admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [ProfilController::class, 'index'])->name('dashboard');

    // Pengaturan Profil (nama, logo, kontak, dll)
    Route::get('/pengaturan-profil', [ProfilController::class, 'editPengaturan'])->name('pengaturan.edit');
    Route::put('/pengaturan-profil/update', [ProfilController::class, 'updatePengaturan'])->name('pengaturan.update');

    // Profil Perusahaan (tampil di landing page)
    Route::get('/profil', [ProfilController::class, 'profilIndex'])->name('profil.index');
    Route::post('/profil', [ProfilController::class, 'profilStore'])->name('profil.store');
    Route::put('/profil/{id}', [ProfilController::class, 'profilUpdate'])->name('profil.update');
    Route::delete('/profil/{id}', [ProfilController::class, 'profilDestroy'])->name('profil.destroy');

    // Layanan
    Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
    Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
    Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
    Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');

    // Portofolio
    Route::get('/portofolio', [PortofolioController::class, 'index'])->name('portofolio.index');
    Route::post('/portofolio', [PortofolioController::class, 'store'])->name('portofolio.store');
    Route::get('/portofolio/{id}', [PortofolioController::class, 'show'])->name('portofolio.show');
    Route::put('/portofolio/{id}', [PortofolioController::class, 'update'])->name('portofolio.update');
    Route::delete('/portofolio/{id}', [PortofolioController::class, 'destroy'])->name('portofolio.destroy');

    // Kreator
    Route::get('/kreator', [KreatorController::class, 'index'])->name('kreator.index');
    Route::post('/kreator', [KreatorController::class, 'store'])->name('kreator.store');
    Route::put('/kreator/{id}', [KreatorController::class, 'update'])->name('kreator.update');
    Route::delete('/kreator/{id}', [KreatorController::class, 'destroy'])->name('kreator.destroy');
});