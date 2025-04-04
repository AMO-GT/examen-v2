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
        try {
            // Valideer de input
            if (empty($medewerkerId) || empty($date)) {
                return response()->json(['error' => 'Medewerker ID en datum zijn vereist'], 400);
            }
            
            // Convert date to Carbon for easier handling
            $carbonDate = Carbon::parse($date);
            $dayOfWeek = $carbonDate->dayOfWeek;
            
            // Log voor debugging
            \Log::info("Tijden ophalen voor medewerker {$medewerkerId} op dag {$dayOfWeek} (datum: {$date})");
            
            // First get the tijd range for this medewerker on this day
            $tijdsblok = Tijdsblok::where('medewerker_id', $medewerkerId)
                ->where('day_of_week', $dayOfWeek)
                ->first();
                
            // Als er geen tijdsblok is, genereer standaardtijden van 9:00 tot 17:00
            if (!$tijdsblok) {
                \Log::warning("Geen tijdsblok gevonden voor medewerker {$medewerkerId} op dag {$dayOfWeek}, standaardtijden worden gebruikt");
                
                $availableTimes = [
                    '09:00:00', '10:00:00', '11:00:00', '12:00:00',
                    '13:00:00', '14:00:00', '15:00:00', '16:00:00'
                ];
                
                // Verwijder tijden die al geboekt zijn
                $bookedTimes = Reservering::where('medewerker_id', $medewerkerId)
                    ->where('datum', $date)
                    ->pluck('tijd')
                    ->map(function($time) {
                        return substr($time, 0, 8); // Get only HH:MM:SS part
                    })
                    ->toArray();
                
                $availableTimes = array_diff($availableTimes, $bookedTimes);
                
                // Als na het verwijderen van geboekte tijden er geen tijden over zijn,
                // maak alle tijden beschikbaar en vermeld in het log dat er geen beschikbare tijden zijn
                if (empty($availableTimes)) {
                    \Log::warning("Alle standaardtijden zijn geboekt voor medewerker {$medewerkerId} op datum {$date}");
                    return response()->json([
                        '09:00:00', '10:00:00', '11:00:00', '12:00:00',
                        '13:00:00', '14:00:00', '15:00:00', '16:00:00'
                    ]);
                }
                
                return response()->json(array_values($availableTimes));
            }
            
            // Parse the start and end times
            $startTime = Carbon::parse($tijdsblok->starttijd);
            $endTime = Carbon::parse($tijdsblok->eindtijd);
            
            \Log::info("Tijdsblok gevonden: {$startTime->format('H:i')} - {$endTime->format('H:i')}");
            
            // Generate one-hour slots
            $availableTimes = [];
            $currentTime = $startTime->copy();
            
            while ($currentTime < $endTime) {
                $timeString = $currentTime->format('H:i:s');
                $availableTimes[] = $timeString;
                $currentTime->addHour();
            }
            
            \Log::info("Gegenereerde tijdslots: " . implode(', ', $availableTimes));
            
            // Remove already booked times
            $bookedTimes = Reservering::where('medewerker_id', $medewerkerId)
                ->where('datum', $date)
                ->pluck('tijd')
                ->map(function($time) {
                    return substr($time, 0, 8); // Get only HH:MM:SS part
                })
                ->toArray();
            
            if (!empty($bookedTimes)) {
                \Log::info("Geboekte tijden: " . implode(', ', $bookedTimes));
            }
            
            $availableTimes = array_diff($availableTimes, $bookedTimes);
            
            // Als er na filtering geen tijden meer over zijn, geef standaardtijden terug
            if (empty($availableTimes)) {
                \Log::warning("Geen beschikbare tijden voor medewerker {$medewerkerId} op datum {$date} na filtering van geboekte tijden");
                return response()->json([
                    '09:00:00', '10:00:00', '11:00:00', '12:00:00',
                    '13:00:00', '14:00:00', '15:00:00', '16:00:00'
                ]);
            }
            
            return response()->json(array_values($availableTimes));
        } catch (\Exception $e) {
            \Log::error("Fout bij het ophalen van beschikbare tijden: " . $e->getMessage());
            return response()->json([
                '09:00:00', '10:00:00', '11:00:00', '12:00:00',
                '13:00:00', '14:00:00', '15:00:00', '16:00:00'
            ]);
        }
    }
} 