<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
        ], [
            'naam.required' => 'Je moet een productnaam invullen.',
            'naam.max' => 'De productnaam mag niet langer zijn dan 100 tekens.',
            'prijs.required' => 'Je moet een prijs invullen.',
            'prijs.numeric' => 'De prijs moet een getal zijn.',
            'prijs.min' => 'De prijs kan niet negatief zijn.',
        ]);

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
        ], [
            'naam.required' => 'Je moet een productnaam invullen.',
            'naam.max' => 'De productnaam mag niet langer zijn dan 100 tekens.',
            'prijs.required' => 'Je moet een prijs invullen.',
            'prijs.numeric' => 'De prijs moet een getal zijn.',
            'prijs.min' => 'De prijs kan niet negatief zijn.',
        ]);

        $product = Product::findOrFail($id);
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
        $product->delete();

        return redirect()->route('producten.index')
            ->with('success', 'Product is succesvol verwijderd.');
    }
} 