@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>Behandeling Bewerken</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('medewerkers.behandeling.update', $behandeling->behandeling_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Categorie</label>
                            <select class="form-control" name="categorie" required>
                                <option value="Knipbehandelingen" {{ $behandeling->categorie == 'Knipbehandelingen' ? 'selected' : '' }}>Knipbehandelingen</option>
                                <option value="Kleurbehandelingen" {{ $behandeling->categorie == 'Kleurbehandelingen' ? 'selected' : '' }}>Kleurbehandelingen</option>
                                <option value="Styling" {{ $behandeling->categorie == 'Styling' ? 'selected' : '' }}>Styling</option>
                                <option value="Treatments" {{ $behandeling->categorie == 'Treatments' ? 'selected' : '' }}>Treatments</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Naam</label>
                            <input type="text" class="form-control" name="naam" value="{{ $behandeling->naam }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Beschrijving</label>
                            <textarea class="form-control" name="beschrijving" rows="3" required>{{ $behandeling->beschrijving }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prijs (€)</label>
                            <input type="number" class="form-control" name="prijs" value="{{ $behandeling->prijs }}" step="0.01" min="0" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Duur (minuten)</label>
                            <input type="number" class="form-control" name="duur_minuten" value="{{ $behandeling->duur_minuten }}" min="1" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('medewerkers.index') }}" class="btn btn-secondary">Annuleren</a>
                            <button type="submit" class="btn btn-primary">Opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 