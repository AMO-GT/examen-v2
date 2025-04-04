<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KlantenController;
use App\Http\Controllers\BeheerdersController;
use App\Http\Controllers\MedewerkersController;
use App\Http\Controllers\Auth\KlantAuthController;
use App\Http\Controllers\ReserveringenController;
use App\Http\Controllers\ApiController;
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

// Klant Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('klant/register', [KlantAuthController::class, 'showRegistrationForm'])->name('klant.register');
    Route::post('klant/register', [KlantAuthController::class, 'register']);
    Route::get('klant/login', [KlantAuthController::class, 'showLoginForm'])->name('klant.login');
    Route::post('klant/login', [KlantAuthController::class, 'login']);
});

Route::middleware('auth:klant')->group(function () {
    Route::post('klant/logout', [KlantAuthController::class, 'logout'])->name('klant.logout');
    
    // Reserveringen routes
    Route::post('/reserveringen', [ReserveringenController::class, 'store'])->name('reserveringen.store');
    Route::delete('/reserveringen/{id}', [ReserveringenController::class, 'destroy'])->name('reserveringen.destroy');
    Route::get('/reserveringen/{id}/edit', [ReserveringenController::class, 'edit'])->name('reserveringen.edit');
    Route::put('/reserveringen/{id}', [ReserveringenController::class, 'update'])->name('reserveringen.update');
});

// API routes voor afspraken maken
Route::get('/api/available-medewerkers/{dayOfWeek}', [ApiController::class, 'getAvailableMedewerkers']);
Route::get('/api/available-times/{medewerkerId}/{date}', [ApiController::class, 'getAvailableTimes']);

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
