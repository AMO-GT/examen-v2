<?php

namespace App\Http\Controllers;

use App\Models\Behandeling;
use App\Models\Medewerker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MedewerkersController extends Controller
{
    public function index()
    {
        try {
            // Haal alle behandelingen op
            $behandelingen = Behandeling::with('medewerkers')->get();
            
            // Log het aantal behandelingen
            \Log::info('Aantal behandelingen opgehaald: ' . $behandelingen->count());
            
            // Log de categorieën
            $categorieen = $behandelingen->pluck('categorie')->unique();
            \Log::info('Gevonden categorieën: ' . $categorieen->implode(', '));
            
            // Log de eerste behandeling als voorbeeld
            if ($behandelingen->isNotEmpty()) {
                \Log::info('Voorbeeld behandeling:', $behandelingen->first()->toArray());
            }

            $medewerkers = Medewerker::all();
            
            return view('medewerkers.index', compact('behandelingen', 'medewerkers'));
        } catch (\Exception $e) {
            \Log::error('Fout bij ophalen behandelingen: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return view('medewerkers.index', ['behandelingen' => collect([])]);
        }
    }

    public function store(Request $request)
    {
        try {
            Log::info('Ontvangen behandeling data:', $request->all());

            $validated = $request->validate([
                'naam' => 'required|string|max:255',
                'beschrijving' => 'required|string',
                'categorie' => 'required|string',
                'prijs' => 'required|numeric|min:0',
                'duur_minuten' => 'required|integer|min:1',
                'is_populair' => 'boolean',
                'medewerker_ids' => 'array'
            ]);

            $behandeling = Behandeling::create([
                'naam' => $validated['naam'],
                'beschrijving' => $validated['beschrijving'],
                'categorie' => $validated['categorie'],
                'prijs' => $validated['prijs'],
                'duur_minuten' => $validated['duur_minuten'],
                'is_populair' => $request->has('is_populair'),
                'is_actief' => true
            ]);

            if ($request->has('medewerker_ids')) {
                $behandeling->medewerkers()->attach($request->medewerker_ids);
            }

            Log::info('Behandeling aangemaakt:', $behandeling->toArray());

            return redirect()->route('medewerkers.index')->with('success', 'Behandeling succesvol toegevoegd!');
        } catch (\Exception $e) {
            Log::error('Fout bij aanmaken behandeling:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $request->all()
            ]);

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

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'naam' => 'required|string|max:255',
                'beschrijving' => 'required|string',
                'categorie' => 'required|string',
                'prijs' => 'required|numeric|min:0',
                'duur_minuten' => 'required|integer|min:1',
                'is_populair' => 'boolean',
                'medewerker_ids' => 'array'
            ]);

            $behandeling = Behandeling::findOrFail($id);
            $behandeling->update([
                'naam' => $validated['naam'],
                'beschrijving' => $validated['beschrijving'],
                'categorie' => $validated['categorie'],
                'prijs' => $validated['prijs'],
                'duur_minuten' => $validated['duur_minuten'],
                'is_populair' => $request->has('is_populair')
            ]);

            $behandeling->medewerkers()->sync($request->medewerker_ids ?? []);

            Log::info('Behandeling bijgewerkt:', [
                'id' => $id,
                'data' => $validated
            ]);

            return redirect()->route('medewerkers.index')->with('success', 'Behandeling succesvol bijgewerkt!');
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

    public function destroy($id)
    {
        try {
            $behandeling = Behandeling::findOrFail($id);
            $behandeling->delete();

            return redirect()->route('medewerkers.index')->with('success', 'Behandeling succesvol verwijderd!');
        } catch (\Exception $e) {
            Log::error('Fout bij verwijderen behandeling:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('medewerkers.index')
                ->with('error', 'Er is een fout opgetreden bij het verwijderen van de behandeling.');
        }
    }

    public function edit($id)
    {
        try {
            $behandeling = Behandeling::with('medewerkers')->findOrFail($id);
            $medewerkers = Medewerker::all();
            return view('medewerkers.edit', compact('behandeling', 'medewerkers'));
        } catch (\Exception $e) {
            \Log::error('Fout bij ophalen behandeling voor bewerken: ' . $e->getMessage());
            return redirect()->route('medewerkers.index')
                ->with('error', 'Behandeling niet gevonden.');
        }
    }
} 