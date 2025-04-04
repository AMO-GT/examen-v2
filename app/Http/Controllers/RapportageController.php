<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tijdsblok;
use App\Models\Medewerker;
use App\Models\Reservering;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RapportageController extends Controller
{
    /**
     * Toon het rapport voor gewerkte uren per medewerker.
     */
    public function urenOverzicht(Request $request)
    {
        // Standaard is huidige maand
        $maand = $request->input('maand', date('m'));
        $jaar = $request->input('jaar', date('Y'));
        $medewerker_id = $request->input('medewerker_id');
        
        // Eerste en laatste dag van de geselecteerde maand
        $startDatum = Carbon::createFromDate($jaar, $maand, 1)->startOfMonth();
        $eindDatum = Carbon::createFromDate($jaar, $maand, 1)->endOfMonth();
        
        // Haal alle medewerkers op
        $medewerkers = Medewerker::all();
        
        // Query voor de gewerkte uren
        $query = DB::table('tijdsblokken')
            ->join('medewerkers', 'tijdsblokken.medewerker_id', '=', 'medewerkers.medewerker_id')
            ->select(
                'medewerkers.medewerker_id',
                'medewerkers.naam',
                DB::raw('SUM(TIMESTAMPDIFF(HOUR, tijdsblokken.starttijd, tijdsblokken.eindtijd)) as totaal_uren'),
                DB::raw('COUNT(DISTINCT DATE(tijdsblokken.datum)) as werkdagen')
            )
            ->whereBetween('tijdsblokken.datum', [$startDatum->toDateString(), $eindDatum->toDateString()]);
            
        // Filter op medewerker als opgegeven
        if ($medewerker_id) {
            $query->where('medewerkers.medewerker_id', $medewerker_id);
        }
        
        // Groeperen en resultaten ophalen
        $gewerkteUren = $query->groupBy('medewerkers.medewerker_id', 'medewerkers.naam')
            ->get();
        
        // Maanden voor dropdown
        $maanden = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maart',
            '04' => 'April',
            '05' => 'Mei', 
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Augustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'December',
        ];
        
        // Jaren voor dropdown (huidige jaar en 2 jaar terug)
        $jaren = range(date('Y')-2, date('Y'));
        
        return view('rapportage.uren-overzicht', compact(
            'gewerkteUren', 
            'medewerkers', 
            'maanden', 
            'jaren', 
            'maand', 
            'jaar',
            'medewerker_id',
            'startDatum',
            'eindDatum'
        ));
    }
} 