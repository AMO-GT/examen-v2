<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class KlantPasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.klant-forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Het e-mailadres is verplicht.',
            'email.email' => 'Voer een geldig e-mailadres in.'
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::broker('klanten')->sendResetLink(
            $request->only('email')
        );

        $customMessages = [
            Password::RESET_LINK_SENT => 'We hebben een e-mail verzonden met instructies om je wachtwoord te herstellen.',
            Password::INVALID_USER => 'We kunnen geen gebruiker vinden met dat e-mailadres.',
            Password::RESET_THROTTLED => 'Wacht even voordat je het opnieuw probeert.'
        ];

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($customMessages[$status] ?? $status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($customMessages[$status] ?? $status)]);
    }
} 