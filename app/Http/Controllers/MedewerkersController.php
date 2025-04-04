<?php

namespace App\Http\Controllers;

use App\Models\Behandeling;
use App\Models\Medewerker;
use App\Models\Product;
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
            $producten = Product::all();
            
            return view('medewerkers.index', compact('behandelingen', 'medewerkers', 'producten'));
        } catch (\Exception $e) {
            \Log::error('Fout bij ophalen behandelingen: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return view('medewerkers.index', [
                'behandelingen' => collect([]),
                'medewerkers' => collect([]),
                'producten' => collect([])
            ]);
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
                'medewerker_ids' => 'array|required',
                'medewerker_ids.*' => 'exists:medewerkers,medewerker_id',
                'product_ids' => 'nullable|array',
                'product_quantities' => 'nullable|array',
                'product_quantities.*' => 'integer|min:1'
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

            // Verwerk de geselecteerde producten
            if ($request->has('product_ids')) {
                $productData = [];
                foreach ($request->product_ids as $productId) {
                    $quantity = 1; // Standaard 1 product per behandeling
                    
                    // Haal het product op
                    $product = Product::findOrFail($productId);
                    
                    // Controleer of er genoeg voorraad is
                    if ($product->voorraad < $quantity) {
                        throw new \Exception("Onvoldoende voorraad voor product: {$product->naam}");
                    }
                    
                    // Update de voorraad
                    $product->voorraad -= $quantity;
                    $product->save();
                    
                    $productData[$productId] = ['aantal' => $quantity];
                    
                    Log::info('Product voorraad bijgewerkt:', [
                        'product_id' => $productId,
                        'naam' => $product->naam,
                        'oude_voorraad' => $product->voorraad + $quantity,
                        'nieuwe_voorraad' => $product->voorraad
                    ]);
                }
                $behandeling->products()->sync($productData);
            }

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
                'medewerker_ids' => 'array',
                'product_ids' => 'nullable|array'
            ]);

            $behandeling = Behandeling::with('products')->findOrFail($id);

            $behandeling->update([
                'naam' => $validated['naam'],
                'beschrijving' => $validated['beschrijving'],
                'categorie' => $validated['categorie'],
                'prijs' => $validated['prijs'],
                'duur_minuten' => $validated['duur_minuten'],
                'is_populair' => $request->has('is_populair')
            ]);

            $behandeling->medewerkers()->sync($request->medewerker_ids ?? []);

            // Update products en voorraad
            if ($request->has('product_ids')) {
                $productData = [];
                $newProductIds = $request->product_ids;
                
                // Herstel voorraad voor verwijderde producten
                foreach ($behandeling->products as $product) {
                    if (!in_array($product->product_id, $newProductIds)) {
                        $product->voorraad += $product->pivot->aantal;
                        $product->save();
                    }
                }
                
                // Update voorraad voor nieuwe en bestaande producten
                foreach ($newProductIds as $productId) {
                    $quantity = 1; // Standaard 1 product per behandeling
                    
                    // Haal het product op
                    $product = Product::findOrFail($productId);
                    
                    // Als het product al aan de behandeling was gekoppeld, hoeven we de voorraad niet aan te passen
                    if (!$behandeling->products->contains($productId)) {
                        // Controleer of er genoeg voorraad is
                        if ($product->voorraad < $quantity) {
                            throw new \Exception("Onvoldoende voorraad voor product: {$product->naam}");
                        }
                        
                        // Update de voorraad alleen voor nieuwe producten
                        $product->voorraad -= $quantity;
                        $product->save();
                        
                        Log::info('Product voorraad bijgewerkt:', [
                            'product_id' => $productId,
                            'naam' => $product->naam,
                            'oude_voorraad' => $product->voorraad + $quantity,
                            'nieuwe_voorraad' => $product->voorraad
                        ]);
                    }
                    
                    $productData[$productId] = ['aantal' => $quantity];
                }
                
                $behandeling->products()->sync($productData);
            } else {
                // Als er geen producten zijn geselecteerd, herstel dan de voorraad van alle huidige producten
                foreach ($behandeling->products as $product) {
                    $product->voorraad += $product->pivot->aantal;
                    $product->save();
                }
                $behandeling->products()->detach();
            }

            return redirect()->route('medewerkers.index')->with('success', 'Behandeling succesvol bijgewerkt!');
        } catch (\Exception $e) {
            Log::error('Fout bij bijwerken behandeling:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $request->all()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Er is een fout opgetreden: ' . $e->getMessage());
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
            $behandeling = Behandeling::with('medewerkers', 'products')->findOrFail($id);
            $medewerkers = Medewerker::all();
            $producten = Product::all();
            return view('medewerkers.edit', compact('behandeling', 'medewerkers', 'producten'));
        } catch (\Exception $e) {
            \Log::error('Fout bij ophalen behandeling voor bewerken: ' . $e->getMessage());
            return redirect()->route('medewerkers.index')
                ->with('error', 'Behandeling niet gevonden.');
        }
    }
} 