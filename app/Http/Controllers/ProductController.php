<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Toon een lijst van alle producten.
     */
    public function index()
    {
        $producten = Product::all();
        return view('producten.index', compact('producten'));
    }

    /**
     * Toon het formulier voor het toevoegen van een nieuw product.
     */
    public function create()
    {
        return view('producten.create');
    }

    /**
     * Sla een nieuw product op in de database.
     */
    public function store(Request $request)
    {
        $validatie = $request->validate([
            'naam' => 'required|string|max:100',
            'prijs' => 'required|numeric|min:0',
            'beschrijving' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'naam.required' => 'Je moet een productnaam invullen.',
            'naam.max' => 'De productnaam mag niet langer zijn dan 100 tekens.',
            'prijs.required' => 'Je moet een prijs invullen.',
            'prijs.numeric' => 'De prijs moet een getal zijn.',
            'prijs.min' => 'De prijs kan niet negatief zijn.',
            'foto.image' => 'Het bestand moet een afbeelding zijn.',
            'foto.mimes' => 'Alleen jpeg, png, jpg en gif bestanden zijn toegestaan.',
            'foto.max' => 'De afbeelding mag niet groter zijn dan 2MB.',
        ]);

        // Verwerk foto upload indien aanwezig
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoNaam = time() . '.' . $foto->getClientOriginalExtension();
            $fotoPad = $foto->storeAs('producten', $fotoNaam, 'public');
            $validatie['foto_pad'] = $fotoPad;
        }

        $product = Product::create($validatie);

        return redirect()->route('producten.index')
            ->with('success', 'Product is succesvol toegevoegd.');
    }

    /**
     * Toon de details van een specifiek product.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('producten.show', compact('product'));
    }

    /**
     * Toon het formulier voor het bewerken van een product.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('producten.edit', compact('product'));
    }

    /**
     * Update het aangegeven product in de database.
     */
    public function update(Request $request, $id)
    {
        $validatie = $request->validate([
            'naam' => 'required|string|max:100',
            'prijs' => 'required|numeric|min:0',
            'beschrijving' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'naam.required' => 'Je moet een productnaam invullen.',
            'naam.max' => 'De productnaam mag niet langer zijn dan 100 tekens.',
            'prijs.required' => 'Je moet een prijs invullen.',
            'prijs.numeric' => 'De prijs moet een getal zijn.',
            'prijs.min' => 'De prijs kan niet negatief zijn.',
            'foto.image' => 'Het bestand moet een afbeelding zijn.',
            'foto.mimes' => 'Alleen jpeg, png, jpg en gif bestanden zijn toegestaan.',
            'foto.max' => 'De afbeelding mag niet groter zijn dan 2MB.',
        ]);

        $product = Product::findOrFail($id);

        // Verwerk foto upload indien aanwezig
        if ($request->hasFile('foto')) {
            // Verwijder oude foto indien aanwezig
            if ($product->foto_pad) {
                Storage::disk('public')->delete($product->foto_pad);
            }
            
            $foto = $request->file('foto');
            $fotoNaam = time() . '.' . $foto->getClientOriginalExtension();
            $fotoPad = $foto->storeAs('producten', $fotoNaam, 'public');
            $validatie['foto_pad'] = $fotoPad;
        }

        $product->update($validatie);

        return redirect()->route('producten.index')
            ->with('success', 'Product is succesvol bijgewerkt.');
    }

    /**
     * Verwijder het aangegeven product uit de database.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Verwijder de foto indien aanwezig
        if ($product->foto_pad) {
            Storage::disk('public')->delete($product->foto_pad);
        }
        
        $product->delete();

        return redirect()->route('producten.index')
            ->with('success', 'Product is succesvol verwijderd.');
    }
} 