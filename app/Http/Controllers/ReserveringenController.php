<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservering;
use App\Models\Medewerker;
use App\Models\Behandeling;
use App\Mail\ReserveringBevestiging;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class ReserveringenController extends Controller
{
    /**
     * Store a newly created reservering in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'datum' => 'required|date|after_or_equal:today',
            'tijd' => [
                'required',
                'regex:/^([0-9]|0[0-9]|1[0-9]|2[0-3]):00:00$/',  // Only allow full hours (9:00, 10:00, etc.)
                Rule::unique('reserveringen')->where(function ($query) use ($request) {
                    return $query->where('medewerker_id', $request->medewerker_id)
                                ->where('datum', $request->datum)
                                ->where('tijd', $request->tijd);
                }),
            ],
            'medewerker_id' => 'required|exists:medewerkers,medewerker_id',
            'behandelingen' => 'required|array',
            'behandelingen.*' => 'exists:behandelingen,behandeling_id',
        ], [
            'datum.required' => 'Selecteer een datum voor uw afspraak.',
            'datum.after_or_equal' => 'De datum moet vandaag of in de toekomst zijn.',
            'tijd.required' => 'Selecteer een tijd voor uw afspraak.',
            'tijd.regex' => 'Afspraken kunnen alleen op hele uren worden gemaakt.',
            'tijd.unique' => 'Deze tijd is al geboekt voor de geselecteerde medewerker op deze datum.',
            'medewerker_id.required' => 'Selecteer een medewerker voor uw afspraak.',
            'behandelingen.required' => 'Selecteer minimaal één behandeling.',
        ]);

        // Maak de reservering aan
        $reservering = Reservering::create([
            'klant_id' => Auth::guard('klant')->id(),
            'medewerker_id' => $request->medewerker_id,
            'datum' => $request->datum,
            'tijd' => $request->tijd,
        ]);

        // Koppel de geselecteerde behandelingen aan de reservering
        $reservering->behandelingen()->attach($request->behandelingen);
        
        // Haal de reservering op met alle relaties voor in de mail
        $reservering = Reservering::with(['klant', 'medewerker', 'behandelingen'])
            ->findOrFail($reservering->reservering_id);
            
        // Zorg dat het klant e-mailadres uit de database wordt gebruikt
        $klantEmail = $reservering->klant->email;
            
        // Stuur een eenvoudige bevestigingsmail
        try {
            // Eenvoudige data voor de mail template
            $mailData = [
                'naam' => $reservering->klant->naam,
                'datum' => $reservering->datum,
                'tijd' => $reservering->tijd,
                'medewerker' => $reservering->medewerker->naam
            ];
            
            Mail::send('emails.simple-reservering-bevestiging', $mailData, function($message) use ($klantEmail) {
                $message->to($klantEmail)
                    ->subject('Bevestiging van uw afspraak bij The Hair Hub');
            });
            
            \Log::info('Bevestigingsmail verzonden naar: ' . $klantEmail);
        } catch (\Exception $e) {
            // Log de error maar laat de gebruiker niet merken dat iets misging
            \Log::error('Er is een fout opgetreden bij het verzenden van de bevestigingsmail: ' . $e->getMessage());
        }

        return redirect()->route('klanten.index')
            ->with('success', 'Uw afspraak is succesvol gemaakt! Een bevestiging is per e-mail verzonden.');
    }
    
    /**
     * Show the form to edit a reservering.
     */
    public function edit($id)
    {
        $reservering = Reservering::findOrFail($id);
        
        // Check of de reservering bij de ingelogde klant hoort
        if ($reservering->klant_id !== Auth::guard('klant')->id()) {
            return redirect()->route('klanten.index')
                ->with('error', 'U bent niet bevoegd om deze afspraak te wijzigen.');
        }
        
        // Haal alle gegevens op die nodig zijn voor het wijzigen van de afspraak
        $medewerkers = Medewerker::all();
        $behandelingen = Behandeling::all();
        $huidigeBehandelingen = $reservering->behandelingen->pluck('behandeling_id')->toArray();
        
        return view('reserveringen.edit', compact('reservering', 'medewerkers', 'behandelingen', 'huidigeBehandelingen'));
    }
    
    /**
     * Update the specified reservering in storage.
     */
    public function update(Request $request, $id)
    {
        $reservering = Reservering::findOrFail($id);
        
        // Check of de reservering bij de ingelogde klant hoort
        if ($reservering->klant_id !== Auth::guard('klant')->id()) {
            return redirect()->route('klanten.index')
                ->with('error', 'U bent niet bevoegd om deze afspraak te wijzigen.');
        }
        
        $request->validate([
            'datum' => 'required|date|after_or_equal:today',
            'tijd' => [
                'required',
                'regex:/^([0-9]|0[0-9]|1[0-9]|2[0-3]):00:00$/',  // Only allow full hours (9:00, 10:00, etc.)
                Rule::unique('reserveringen')->where(function ($query) use ($request, $id) {
                    return $query->where('medewerker_id', $request->medewerker_id)
                                ->where('datum', $request->datum)
                                ->where('tijd', $request->tijd)
                                ->where('reservering_id', '!=', $id); // Exclude the current reservation
                }),
            ],
            'medewerker_id' => 'required|exists:medewerkers,medewerker_id',
            'behandelingen' => 'required|array',
            'behandelingen.*' => 'exists:behandelingen,behandeling_id',
        ], [
            'datum.required' => 'Selecteer een datum voor uw afspraak.',
            'datum.after_or_equal' => 'De datum moet vandaag of in de toekomst zijn.',
            'tijd.required' => 'Selecteer een tijd voor uw afspraak.',
            'tijd.regex' => 'Afspraken kunnen alleen op hele uren worden gemaakt.',
            'tijd.unique' => 'Deze tijd is al geboekt voor de geselecteerde medewerker op deze datum.',
            'medewerker_id.required' => 'Selecteer een medewerker voor uw afspraak.',
            'behandelingen.required' => 'Selecteer minimaal één behandeling.',
        ]);
        
        // Update de reservering
        $reservering->update([
            'medewerker_id' => $request->medewerker_id,
            'datum' => $request->datum,
            'tijd' => $request->tijd,
        ]);
        
        // Werk de behandelingen bij door de oude te verwijderen en nieuwe toe te voegen
        $reservering->behandelingen()->sync($request->behandelingen);
        
        // Haal de reservering op met alle relaties voor in de mail
        $reservering = Reservering::with(['klant', 'medewerker', 'behandelingen'])
            ->findOrFail($id);
            
        // Zorg dat het klant e-mailadres uit de database wordt gebruikt
        $klantEmail = $reservering->klant->email;
            
        // Stuur een eenvoudige bevestigingsmail voor de update
        try {
            // Eenvoudige data voor de mail template
            $mailData = [
                'naam' => $reservering->klant->naam,
                'datum' => $reservering->datum,
                'tijd' => $reservering->tijd,
                'medewerker' => $reservering->medewerker->naam,
                'is_update' => true
            ];
            
            Mail::send('emails.simple-reservering-bevestiging', $mailData, function($message) use ($klantEmail) {
                $message->to($klantEmail)
                    ->subject('Wijziging van uw afspraak bij The Hair Hub');
            });
            
            \Log::info('Update-bevestigingsmail verzonden naar: ' . $klantEmail);
        } catch (\Exception $e) {
            // Log de error maar laat de gebruiker niet merken dat iets misging
            \Log::error('Er is een fout opgetreden bij het verzenden van de update-bevestigingsmail: ' . $e->getMessage());
        }
        
        return redirect()->route('klanten.index')
            ->with('success', 'Uw afspraak is succesvol bijgewerkt! Een nieuwe bevestiging is per e-mail verzonden.');
    }

    /**
     * Remove the specified reservering from storage.
     */
    public function destroy($id)
    {
        $reservering = Reservering::findOrFail($id);
        
        // Check of de reservering bij de ingelogde klant hoort
        if ($reservering->klant_id !== Auth::guard('klant')->id()) {
            return redirect()->route('klanten.index')
                ->with('error', 'U bent niet bevoegd om deze afspraak te annuleren.');
        }

        // Haal de reservering op met alle relaties voor in de mail
        $reservering = Reservering::with(['klant', 'medewerker', 'behandelingen'])
            ->findOrFail($id);
            
        // E-mailadres en gegevens van klant opslaan voor bevestigingsmail na verwijderen
        $klantEmail = $reservering->klant->email;
        $klantNaam = $reservering->klant->naam;
        $afspraakDatum = $reservering->datum;
        $afspraakTijd = $reservering->tijd;
        $medewerkerNaam = $reservering->medewerker->naam;

        // Verwijder de reservering (en door cascade ook de gekoppelde behandelingen)
        $reservering->delete();
        
        // Stuur een eenvoudige annuleringsmail
        try {
            // Eenvoudige data voor de mail template
            $mailData = [
                'naam' => $klantNaam,
                'datum' => $afspraakDatum,
                'tijd' => $afspraakTijd,
                'medewerker' => $medewerkerNaam,
                'is_cancel' => true
            ];
            
            Mail::send('emails.simple-reservering-bevestiging', $mailData, function($message) use ($klantEmail) {
                $message->to($klantEmail)
                    ->subject('Annulering van uw afspraak bij The Hair Hub');
            });
            
            \Log::info('Annuleringsmail verzonden naar: ' . $klantEmail);
        } catch (\Exception $e) {
            // Log de error maar laat de gebruiker niet merken dat iets misging
            \Log::error('Er is een fout opgetreden bij het verzenden van de annuleringsmail: ' . $e->getMessage());
        }

        return redirect()->route('klanten.index')
            ->with('success', 'Uw afspraak is succesvol geannuleerd! Een bevestiging van annulering is per e-mail verzonden.');
    }
} 