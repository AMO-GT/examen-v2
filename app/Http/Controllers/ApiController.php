<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medewerker;
use App\Models\Tijdsblok;
use App\Models\Reservering;
use Carbon\Carbon;

class ApiController extends Controller
{
    /**
     * Get medewerkers available on a specific day of the week
     */
    public function getAvailableMedewerkers($dayOfWeek)
    {
        // Find all medewerkers that have a tijdsblok on this day
        $medewerkers = Medewerker::whereHas('tijdsblokken', function($query) use ($dayOfWeek) {
            $query->where('day_of_week', $dayOfWeek);
        })->with('behandelingen')->get();
        
        // Format response to include medewerker_id, naam, and behandelingen
        $response = $medewerkers->map(function($medewerker) {
            return [
                'medewerker_id' => $medewerker->medewerker_id,
                'naam' => $medewerker->naam,
                'behandelingen' => $medewerker->behandelingen->map(function($behandeling) {
                    return [
                        'behandeling_id' => $behandeling->behandeling_id,
                        'naam' => $behandeling->naam,
                        'prijs' => $behandeling->prijs,
                        'duur' => $behandeling->duur
                    ];
                })
            ];
        });
        
        return response()->json($response);
    }
    
    /**
     * Get available times for a specific medewerker on a specific date
     */
    public function getAvailableTimes($medewerkerId, $date)
    {
        // Convert date to Carbon for easier handling
        $carbonDate = Carbon::parse($date);
        $dayOfWeek = $carbonDate->dayOfWeek;
        
        // First get the tijd range for this medewerker on this day
        $tijdsblok = Tijdsblok::where('medewerker_id', $medewerkerId)
            ->where('day_of_week', $dayOfWeek)
            ->first();
            
        if (!$tijdsblok) {
            return response()->json([]);
        }
        
        // Parse the start and end times
        $startTime = Carbon::parse($tijdsblok->starttijd);
        $endTime = Carbon::parse($tijdsblok->eindtijd);
        
        // Generate one-hour slots
        $availableTimes = [];
        $currentTime = $startTime->copy();
        
        while ($currentTime < $endTime) {
            $timeString = $currentTime->format('H:i:s');
            $availableTimes[] = $timeString;
            $currentTime->addHour();
        }
        
        // Remove already booked times
        $bookedTimes = Reservering::where('medewerker_id', $medewerkerId)
            ->where('datum', $date)
            ->pluck('tijd')
            ->map(function($time) {
                return substr($time, 0, 8); // Get only HH:MM:SS part
            })
            ->toArray();
        
        $availableTimes = array_diff($availableTimes, $bookedTimes);
        
        return response()->json(array_values($availableTimes));
    }
} 