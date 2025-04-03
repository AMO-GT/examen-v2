<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Klant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class KlantAuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.klant-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'naam' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:klanten'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'telefoon' => ['nullable', 'string', 'max:20'],
            'adres' => ['nullable', 'string', 'max:255'],
            'postcode' => ['nullable', 'string', 'max:10'],
            'plaats' => ['nullable', 'string', 'max:100'],
        ]);

        $klant = Klant::create([
            'naam' => $request->naam,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefoon' => $request->telefoon,
            'adres' => $request->adres,
            'postcode' => $request->postcode,
            'plaats' => $request->plaats,
        ]);

        Auth::guard('klant')->login($klant);

        return redirect()->route('klanten.index');
    }

    public function showLoginForm()
    {
        return view('auth.klant-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('klant')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('klanten.index'));
        }

        return back()->withErrors([
            'email' => 'De opgegeven inloggegevens zijn niet correct.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('klant')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
} 