<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KlantenController;
use App\Http\Controllers\BeheerdersController;
use App\Http\Controllers\MedewerkersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedewerkerController;
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
    Route::get('/medewerkers/behandeling', [MedewerkersController::class, 'index'])->name('medewerkers.behandeling.index');
    Route::post('/medewerkers/behandeling', [MedewerkersController::class, 'store'])->name('medewerkers.behandeling.store');
    Route::get('/medewerkers/behandeling/{id}', [MedewerkersController::class, 'getBehandeling'])->name('medewerkers.behandeling.get');
    Route::post('/medewerkers/behandeling/{id}', [MedewerkersController::class, 'update'])->name('medewerkers.behandeling.update');
    Route::post('/medewerkers/behandeling/{id}/delete', [MedewerkersController::class, 'destroy'])->name('medewerkers.behandeling.delete');
    Route::get('/medewerkers/behandeling/{id}/edit', [MedewerkersController::class, 'edit'])->name('medewerkers.behandeling.edit');
    
    // Klanten routes
    Route::get('/klanten', [KlantenController::class, 'index'])->name('klanten.index');
});

require __DIR__.'/auth.php';
