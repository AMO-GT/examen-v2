<?php

namespace App\Http\Controllers;
use App\Models\Medewerker;

use Illuminate\Http\Request;

class BeheerdersController extends Controller
{
    public function index()
    {
        $medewerkers = Medewerker::all();
        return view('beheerders.index', compact('medewerkers'));
    }

    // Formulier tonen voor medewerkers.create
    public function create()
    {
        return view('beheerders.create'); // Let op: de view heet medewerkers.create
    }

    // Opslaan van medewerker via medewerkers.store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'naam' => 'required|string|max:100',
            'email' => 'required|email|unique:medewerkers,email',
        ]);

        Medewerker::create($validated);

        return redirect()->route('beheerders.index')->with('success', 'Medewerker succesvol toegevoegd.');
    }

    public function show(Medewerker $medewerker)
    {
        return view('beheerders.show', compact('medewerker'));
    }


    public function edit(Medewerker $medewerker)
    {
        return view('beheerders.edit', compact('medewerker'));
    }

    public function update(Request $request, Medewerker $medewerker)
    {
        $validated = $request->validate([
            'naam' => 'required|string|max:100',
            'email' => 'required|email|unique:medewerkers,email,' . $medewerker->medewerker_id . ',medewerker_id',
        ]);

        $medewerker->update($validated);

        return redirect()->route('beheerders.index')->with('success', 'Medewerker bijgewerkt.');
    }


    public function destroy(Medewerker $medewerker)
    {
        $medewerker->delete();
        return redirect()->route('beheerders.index')->with('success', 'Medewerker verwijderd.');
    }

}
