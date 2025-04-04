<?php

namespace App\Http\Controllers;

use App\Models\Behandeling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MedewerkersController extends Controller
{
    public function index()
    {
        try {
            // Haal alle behandelingen op
            $behandelingen = Behandeling::all();
            
            // Log het aantal behandelingen
            \Log::info('Aantal behandelingen opgehaald: ' . $behandelingen->count());
            
            // Log de categorieën
            $categorieen = $behandelingen->pluck('categorie')->unique();
            \Log::info('Gevonden categorieën: ' . $categorieen->implode(', '));
            
            // Log de eerste behandeling als voorbeeld
            if ($behandelingen->isNotEmpty()) {
                \Log::info('Voorbeeld behandeling:', $behandelingen->first()->toArray());
            }
            
            return view('medewerkers.index', compact('behandelingen'));
        } catch (\Exception $e) {
            \Log::error('Fout bij ophalen behandelingen: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return view('medewerkers.index', ['behandelingen' => collect([])]);
        }
    }

    public function storeBehandeling(Request $request)
    {
        try {
            Log::info('Ontvangen behandeling data:', $request->all());

            $validated = $request->validate([
                'naam' => 'required|string|max:255',
                'beschrijving' => 'required|string',
                'categorie' => 'required|string|in:Knipbehandelingen,Kleurbehandelingen,Styling,Treatments',
                'prijs' => 'required|numeric|min:0',
                'duur_minuten' => 'required|integer|min:1'
            ]);

            Log::info('Gevalideerde data:', $validated);

            $behandeling = Behandeling::create($validated);
            
            Log::info('Behandeling aangemaakt:', $behandeling->toArray());

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Behandeling succesvol toegevoegd',
                    'behandeling' => $behandeling
                ]);
            }

            return redirect()->route('medewerkers.index')
                ->with('success', 'Behandeling succesvol toegevoegd');
        } catch (\Exception $e) {
            Log::error('Fout bij aanmaken behandeling:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $request->all()
            ]);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Er is een fout opgetreden: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Er is een fout opgetreden: ' . $e->getMessage()]);
        }
    }

    public function getBehandeling($id)
    {
        try {
            $behandeling = Behandeling::findOrFail($id);
            return response()->json($behandeling);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function updateBehandeling(Request $request, $id)
    {
        try {
            $behandeling = Behandeling::findOrFail($id);
            
            $validated = $request->validate([
                'naam' => 'required|string|max:255',
                'beschrijving' => 'required|string',
                'categorie' => 'required|string|in:Knipbehandelingen,Kleurbehandelingen,Styling,Treatments',
                'prijs' => 'required|numeric|min:0',
                'duur_minuten' => 'required|integer|min:1'
            ]);

            $behandeling->update($validated);

            Log::info('Behandeling bijgewerkt:', [
                'id' => $id,
                'data' => $validated
            ]);

            return redirect()->route('medewerkers.index')
                           ->with('success', 'De behandeling is succesvol bijgewerkt.');
        } catch (\Exception $e) {
            Log::error('Fout bij bijwerken behandeling:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $request->all()
            ]);

            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Er is een fout opgetreden bij het bijwerken van de behandeling.');
        }
    }

    public function deleteBehandeling($id)
    {
        try {
            $behandeling = Behandeling::findOrFail($id);
            $behandeling->delete();

            return redirect()->route('medewerkers.index')
                           ->with('success', 'De behandeling is succesvol verwijderd.');
        } catch (\Exception $e) {
            Log::error('Fout bij verwijderen behandeling:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('medewerkers.index')
                           ->with('error', 'Er is een fout opgetreden bij het verwijderen van de behandeling.');
        }
    }

    public function editBehandeling($id)
    {
        try {
            $behandeling = Behandeling::findOrFail($id);
            return view('medewerkers.edit', compact('behandeling'));
        } catch (\Exception $e) {
            \Log::error('Fout bij ophalen behandeling voor bewerken: ' . $e->getMessage());
            return redirect()->route('medewerkers.index')
                           ->with('error', 'Behandeling niet gevonden.');
        }
    }
} 