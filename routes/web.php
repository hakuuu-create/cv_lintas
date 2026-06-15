<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Media\MediaController;


/**
 * ROUTE PUBLIC
 **/

Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');
Route::get('/kegiatan/{slug}', [LandingPageController::class, 'detailKegiatan'])->name('landing.kegiatan.detail');


/**
 * ROUTE AUTENTIKASI
 **/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('dashboard-media')->group(function () {

    // Halaman Utama Dashboard Media
    Route::get('/', [MediaController::class, 'index'])->name('media.dashboard');

    // CRUD Profil Pesantren
    Route::get('/profil', [MediaController::class, 'editProfil'])->name('media.profil.edit');
    Route::put('/profil/update', [MediaController::class, 'updateProfil'])->name('media.profil.update');

    // CRUD Berita / Kegiatan Pesantren berbasis AJAX Modal
    Route::get('/kegiatan', [MediaController::class, 'indexKegiatan'])->name('media.kegiatan.index');
    Route::post('/kegiatan/store', [MediaController::class, 'storeKegiatan'])->name('media.kegiatan.store');
    Route::get('/kegiatan/{id}/edit', [MediaController::class, 'editKegiatan']);
    Route::put('/kegiatan/{id}/update', [MediaController::class, 'updateKegiatan'])->name('media.kegiatan.update');
    Route::delete('/kegiatan/{id}/delete', [MediaController::class, 'destroyKegiatan'])->name('media.kegiatan.destroy');
});

