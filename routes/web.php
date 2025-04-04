<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KlantenController;
use App\Http\Controllers\BeheerdersController;
use App\Http\Controllers\MedewerkersController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Beheerders routes
    Route::get('/beheerders', [BeheerdersController::class, 'index'])->name('beheerders.index');
    
    // Medewerkers routes
    Route::get('/medewerkers', [MedewerkersController::class, 'index'])->name('medewerkers.index');
    Route::post('/medewerkers/behandeling', [MedewerkersController::class, 'storeBehandeling'])->name('medewerkers.behandeling.store');
    Route::get('/medewerkers/behandeling/{id}/edit', [MedewerkersController::class, 'editBehandeling'])->name('medewerkers.behandeling.edit');
    Route::put('/medewerkers/behandeling/{id}', [MedewerkersController::class, 'updateBehandeling'])->name('medewerkers.behandeling.update');
    Route::delete('/medewerkers/behandeling/{id}', [MedewerkersController::class, 'deleteBehandeling'])->name('medewerkers.behandeling.delete');
    
    // Klanten routes
    Route::get('/klanten', [KlantenController::class, 'index'])->name('klanten.index');
});

require __DIR__.'/auth.php';
