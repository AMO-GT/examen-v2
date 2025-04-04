<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KlantenController;
use App\Http\Controllers\BeheerdersController;
use App\Http\Controllers\MedewerkersController;
use App\Http\Controllers\TijdsblokController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

//<-----------------------------------------AHMAD----------------------------------------->
// Beheerders routes
Route::get('/beheerders', [BeheerdersController::class, 'index'])->name('beheerders.index');
Route::get('/medewerkers/create', [BeheerdersController::class, 'create'])->name('medewerkers.create');
Route::post('/medewerkers', [BeheerdersController::class, 'store'])->name('medewerkers.store');
Route::get('/medewerkers/{medewerker}', [BeheerdersController::class, 'show'])->name('medewerkers.show');
Route::get('/medewerkers/{medewerker}/edit', [BeheerdersController::class, 'edit'])->name('medewerkers.edit');
Route::put('/medewerkers/{medewerker}', [BeheerdersController::class, 'update'])->name('medewerkers.update');
Route::delete('/medewerkers/{medewerker}', [BeheerdersController::class, 'destroy'])->name('medewerkers.destroy');


Route::get('/tijdsblokken', [TijdsblokController::class, 'index'])->name('tijdsblokken.index');
Route::get('/tijdsblokken/create', [TijdsblokController::class, 'create'])->name('tijdsblokken.create');
Route::post('/tijdsblokken', [TijdsblokController::class, 'store'])->name('tijdsblokken.store');
Route::get('/tijdsblokken/{tijdsblok}/edit', [TijdsblokController::class, 'edit'])->name('tijdsblokken.edit');
Route::put('/tijdsblokken/{tijdsblok}', [TijdsblokController::class, 'update'])->name('tijdsblokken.update');
Route::delete('/tijdsblokken/{tijdsblok}', [TijdsblokController::class, 'destroy'])->name('tijdsblokken.destroy');
//<-----------------------------------------AHMAD----------------------------------------->
//<-----------------------------------------Moooo----------------------------------------->
// Medewerkers routes
Route::get('/medewerkers', [MedewerkersController::class, 'index'])->name('medewerkers.index');



//<-----------------------------------------Aoooo----------------------------------------->
//<-----------------------------------------Badr------------------------------------------>

// Klanten routes
Route::get('/klanten', [KlantenController::class, 'index'])->name('klanten.index');








//<-----------------------------------------Badr------------------------------------------>


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

require __DIR__.'/auth.php';
