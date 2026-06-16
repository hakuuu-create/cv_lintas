<?php

use App\Http\Controllers\Media\CardController;
use App\Http\Controllers\Media\CreatorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Media\MediaController;
use App\Http\Controllers\Media\PortofolioController;


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

Route::middleware(['auth', 'role:admin'])->prefix('dashboard')->group(function () {

    //  Halaman Utama Dashboard Media
    // Route::get('/', [MediaController::class, 'index'])->name('media.dashboard');

    // Profil perusahan
    Route::get('/', [MediaController::class, 'editProfil'])->name('media.profil.edit');
    Route::put('/profil/update', [MediaController::class, 'updateProfil'])->name('media.profil.update');

    // Portofolio 
    Route::get('/portofolio', [PortofolioController::class, 'index'])->name('portofolio.index');
    Route::post('/portofolio', [PortofolioController::class, 'store'])->name('portofolio.store');
    Route::get('/portofolio/{id}', [PortofolioController::class, 'show'])->name('portofolio.show');
    Route::put('/portofolio/{id}', [PortofolioController::class, 'update'])->name('portofolio.update');
    Route::delete('/portofolio/delete/{id}', [PortofolioController::class, 'destroy'])->name('portofolio.destroy');

    // Creator
    Route::get('/creator', [CreatorController::class, 'edit'])->name('media.creator.edit');
    Route::put('/creator/update', [CreatorController::class, 'update'])->name('media.creator.update');
});