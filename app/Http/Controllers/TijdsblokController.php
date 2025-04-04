<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Tijdsblok;
use App\Models\Medewerker;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TijdsblokController extends Controller
{
    // Toont het overzicht van alle tijdsblokken
    public function index(Request $request)
    {
        $medewerkers = Medewerker::all();
        
        // Query bouwen om te filteren
        $query = Tijdsblok::with('medewerker');
        
        // Filter op medewerker als die is opgegeven
        if ($request->has('filter_medewerker') && !empty($request->filter_medewerker)) {
            $query->where('medewerker_id', $request->filter_medewerker);
        }
        
        // Filter op datum als die is opgegeven
        if ($request->has('filter_datum') && !empty($request->filter_datum)) {
            $query->whereDate('datum', $request->filter_datum);
        }
        
        // Filter op periode als die is opgegeven
        if ($request->has('filter_periode')) {
            switch ($request->filter_periode) {
                case 'huidige_maand':
                    $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
                    $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d');
                    $query->whereBetween('datum', [$startOfMonth, $endOfMonth]);
                    break;
                    
                case 'vorige_maand':
                    $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
                    $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
                    $query->whereBetween('datum', [$startOfLastMonth, $endOfLastMonth]);
                    break;
                    
                case 'deze_week':
                    $startOfWeek = Carbon::now()->startOfWeek()->format('Y-m-d');
                    $endOfWeek = Carbon::now()->endOfWeek()->format('Y-m-d');
                    $query->whereBetween('datum', [$startOfWeek, $endOfWeek]);
                    break;
            }
        }
        
        // Haal gefilterde resultaten op
        $tijdsblokken = $query->get();
        
        return view('tijdsblokken.index', compact('medewerkers', 'tijdsblokken'));
    }

    // Toont het formulier voor het aanmaken van een nieuw tijdsblok
    public function create()
    {
        $medewerkers = Medewerker::all();
        return view('tijdsblokken.create', compact('medewerkers'));
    }

    // Slaat een nieuw tijdsblok op in de database
    public function store(Request $request)
    {
        $validatie = $request->validate([
            'medewerker_id' => 'required|exists:medewerkers,medewerker_id',
            'datum' => 'required|date',
            'startuur' => 'required|integer|between:8,16',
            'einduur' => 'required|integer|between:9,17|gt:startuur',
        ], [
            'medewerker_id.required' => 'Je moet een medewerker selecteren.',
            'medewerker_id.exists' => 'De geselecteerde medewerker bestaat niet.',
            'datum.required' => 'Je moet een datum invullen.',
            'datum.date' => 'De datum moet een geldige datum zijn.',
            'startuur.required' => 'Je moet een starttijd selecteren.',
            'startuur.integer' => 'De starttijd moet een geldig uur zijn.',
            'startuur.between' => 'De starttijd moet tussen 8 en 16 uur zijn.',
            'einduur.required' => 'Je moet een eindtijd selecteren.',
            'einduur.integer' => 'De eindtijd moet een geldig uur zijn.',
            'einduur.between' => 'De eindtijd moet tussen 9 en 17 uur zijn.',
            'einduur.gt' => 'De eindtijd moet later zijn dan de starttijd.',
        ]);

        $tijdsblok = Tijdsblok::create([
            'medewerker_id' => $request->medewerker_id,
            'datum' => $request->datum,
            'starttijd' => $request->startuur . ':00:00',
            'eindtijd' => $request->einduur . ':00:00',
        ]);

        return redirect()->route('tijdsblokken.index')
            ->with('success', 'Tijdsblok is succesvol opgeslagen.');
    }

    // Toont een formulier om een bestaand tijdsblok te bewerken
    public function edit($id)
    {
        $tijdsblok = Tijdsblok::findOrFail($id);
        $medewerkers = Medewerker::all();
        return view('tijdsblokken.edit', compact('tijdsblok', 'medewerkers'));
    }

    // Update een bestaand tijdsblok in de database
    public function update(Request $request, $id)
    {
        $validatie = $request->validate([
            'medewerker_id' => 'required|exists:medewerkers,medewerker_id',
            'datum' => 'required|date',
            'startuur' => 'required|integer|between:8,16',
            'einduur' => 'required|integer|between:9,17|gt:startuur',
        ], [
            'medewerker_id.required' => 'Je moet een medewerker selecteren.',
            'medewerker_id.exists' => 'De geselecteerde medewerker bestaat niet.',
            'datum.required' => 'Je moet een datum invullen.',
            'datum.date' => 'De datum moet een geldige datum zijn.',
            'startuur.required' => 'Je moet een starttijd selecteren.',
            'startuur.integer' => 'De starttijd moet een geldig uur zijn.',
            'startuur.between' => 'De starttijd moet tussen 8 en 16 uur zijn.',
            'einduur.required' => 'Je moet een eindtijd selecteren.',
            'einduur.integer' => 'De eindtijd moet een geldig uur zijn.',
            'einduur.between' => 'De eindtijd moet tussen 9 en 17 uur zijn.',
            'einduur.gt' => 'De eindtijd moet later zijn dan de starttijd.',
        ]);

        $tijdsblok = Tijdsblok::findOrFail($id);
        $tijdsblok->update([
            'medewerker_id' => $request->medewerker_id,
            'datum' => $request->datum,
            'starttijd' => $request->startuur . ':00:00',
            'eindtijd' => $request->einduur . ':00:00',
        ]);

        return redirect()->route('tijdsblokken.index')
            ->with('success', 'Tijdsblok is succesvol bijgewerkt.');
    }

    // Verwijder een tijdsblok uit de database
    public function destroy($id)
    {
        $tijdsblok = Tijdsblok::findOrFail($id);
        $tijdsblok->delete();

        return redirect()->route('tijdsblokken.index')
            ->with('success', 'Tijdsblok is succesvol verwijderd.');
    }
}
