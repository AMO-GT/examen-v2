<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class KlantNewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.klant-reset-password', [
            'request' => $request
        ]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'email.required' => 'Het e-mailadres is verplicht.',
            'email.email' => 'Voer een geldig e-mailadres in.',
            'password.required' => 'Het wachtwoord is verplicht.',
            'password.confirmed' => 'De wachtwoord bevestiging komt niet overeen.',
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::broker('klanten')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        $customMessages = [
            Password::PASSWORD_RESET => 'Je wachtwoord is succesvol hersteld!',
            Password::INVALID_TOKEN => 'Deze wachtwoord herstel link is ongeldig.',
            Password::INVALID_USER => 'We kunnen geen gebruiker vinden met dat e-mailadres.',
            Password::RESET_THROTTLED => 'Wacht even voordat je het opnieuw probeert.',
        ];

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? redirect('/klanten')->with('status', __($customMessages[$status] ?? $status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($customMessages[$status] ?? $status)]);
    }
} 