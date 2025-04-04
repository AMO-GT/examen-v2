<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Medewerker;
use App\Models\Behandeling;
use App\Models\Klant;

class KlantenController extends Controller
{
    public function index()
    {
        $isAuthenticated = Auth::guard('klant')->check();
        $klant = $isAuthenticated ? Auth::guard('klant')->user() : null;
        
        $data = [
            'isAuthenticated' => $isAuthenticated,
            'klant' => $klant
        ];
        
        if ($isAuthenticated) {
            $data['medewerkers'] = Medewerker::all();
            $data['behandelingen'] = Behandeling::all();
        }
        
        return view('klanten.index', $data);
    }
    
    /**
     * Toon het formulier voor het bewerken van klantgegevens.
     */
    public function edit()
    {
        $klant = Auth::guard('klant')->user();
        return view('klanten.edit', ['klant' => $klant]);
    }
    
    /**
     * Update de klantgegevens in de database.
     */
    public function update(Request $request)
    {
        $klant = Auth::guard('klant')->user();
        
        $validated = $request->validate([
            'naam' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:klanten,email,'.$klant->klant_id.',klant_id',
            'telefoon' => 'nullable|string|max:20',
            'adres' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:10',
            'plaats' => 'nullable|string|max:100',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        
        $klant->naam = $validated['naam'];
        $klant->email = $validated['email'];
        $klant->telefoon = $validated['telefoon'];
        $klant->adres = $validated['adres'];
        $klant->postcode = $validated['postcode'];
        $klant->plaats = $validated['plaats'];
        
        // Controleer of het wachtwoord is gewijzigd
        $passwordChanged = false;
        
        if (!empty($validated['password'])) {
            $klant->password = Hash::make($validated['password']);
            $passwordChanged = true;
        }
        
        $klant->save();
        
        // Stuur een e-mail als het wachtwoord is gewijzigd
        if ($passwordChanged) {
            try {
                // Data voor de e-mail template
                $mailData = [
                    'naam' => $klant->naam,
                    'email' => $klant->email,
                    'is_password_change' => true
                ];
                
                // Verstuur de e-mail
                \Illuminate\Support\Facades\Mail::send('emails.wachtwoord-gewijzigd', $mailData, function($message) use ($klant) {
                    $message->to($klant->email)
                        ->subject('Uw wachtwoord is gewijzigd bij The Hair Hub');
                });
                
                \Illuminate\Support\Facades\Log::info('Wachtwoord-wijziging e-mail verzonden naar: ' . $klant->email);
            } catch (\Exception $e) {
                // Log de error maar laat de gebruiker niet merken dat iets misging
                \Illuminate\Support\Facades\Log::error('Er is een fout opgetreden bij het verzenden van de wachtwoord-wijziging e-mail: ' . $e->getMessage());
            }
        }
        
        return redirect()->route('klanten.index')->with('success', 'Uw gegevens zijn succesvol bijgewerkt!');
    }
} 