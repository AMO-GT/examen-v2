<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservering;
use App\Models\Medewerker;
use App\Models\Behandeling;
use Illuminate\Support\Facades\Auth;
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

        return redirect()->route('klanten.index')
            ->with('success', 'Uw afspraak is succesvol gemaakt!');
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
        
        return redirect()->route('klanten.index')
            ->with('success', 'Uw afspraak is succesvol bijgewerkt!');
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

        // Verwijder de reservering (en door cascade ook de gekoppelde behandelingen)
        $reservering->delete();

        return redirect()->route('klanten.index')
            ->with('success', 'Uw afspraak is succesvol geannuleerd!');
    }
} 