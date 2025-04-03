<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KlantenController;
use App\Http\Controllers\BeheerdersController;
use App\Http\Controllers\MedewerkersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

//<-----------------------------------------AHMAD----------------------------------------->
// Beheerders routes
Route::get('/beheerders', [BeheerdersController::class, 'index'])->name('beheerders.index');



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
