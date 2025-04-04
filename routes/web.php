<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KlantenController;
use App\Http\Controllers\BeheerdersController;
use App\Http\Controllers\MedewerkersController;
use App\Http\Controllers\Auth\KlantAuthController;
use App\Http\Controllers\ReserveringenController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\KlantPasswordResetLinkController;
use App\Http\Controllers\Auth\KlantNewPasswordController;
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

// Klant Password Reset Routes
Route::get('klant/forgot-password', [KlantPasswordResetLinkController::class, 'create'])
     ->name('klant.password.request');
Route::post('klant/forgot-password', [KlantPasswordResetLinkController::class, 'store'])
     ->name('klant.password.email');
Route::get('klant/reset-password/{token}', [KlantNewPasswordController::class, 'create'])
     ->name('klant.password.reset');
Route::post('klant/reset-password', [KlantNewPasswordController::class, 'store'])
     ->name('klant.password.store');

Route::middleware('auth:klant')->group(function () {
    Route::post('klant/logout', [KlantAuthController::class, 'logout'])->name('klant.logout');
    
    // Klantgegevens routes
    Route::get('/klant/edit', [KlantenController::class, 'edit'])->name('klant.edit');
    Route::put('/klant/update', [KlantenController::class, 'update'])->name('klant.update');
    
    // Reserveringen routes
    Route::post('/reserveringen', [ReserveringenController::class, 'store'])->name('reserveringen.store');
    Route::delete('/reserveringen/{id}', [ReserveringenController::class, 'destroy'])->name('reserveringen.destroy');
    Route::get('/reserveringen/{id}/edit', [ReserveringenController::class, 'edit'])->name('reserveringen.edit');
    Route::put('/reserveringen/{id}', [ReserveringenController::class, 'update'])->name('reserveringen.update');
});

// API routes voor afspraken maken
Route::get('/api/available-medewerkers/{dayOfWeek}', [ApiController::class, 'getAvailableMedewerkers']);
Route::get('/api/available-times/{medewerkerId}/{date}', [ApiController::class, 'getAvailableTimes']);

// Test route voor e-mail
Route::get('/test-email', function() {
    $reservering = \App\Models\Reservering::with(['klant', 'medewerker', 'behandelingen'])->first();
    
    if (!$reservering) {
        return 'Geen reserveringen gevonden om te testen';
    }
    
    try {
        $mailData = [
            'naam' => $reservering->klant->naam,
            'datum' => $reservering->datum,
            'tijd' => $reservering->tijd,
            'medewerker' => $reservering->medewerker->naam
        ];
        
        \Illuminate\Support\Facades\Mail::send('emails.simple-reservering-bevestiging', $mailData, function($message) use ($reservering) {
            $message->to($reservering->klant->email)
                ->subject('TEST - Bevestiging van uw afspraak bij The Hair Hub');
        });
        
        return 'E-mail verzonden naar ' . $reservering->klant->email . '. Check je e-mail!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

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
