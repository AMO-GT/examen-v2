@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Behandeling Bewerken</h2>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('medewerkers.behandeling.update', $behandeling->behandeling_id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="categorie" class="form-label">Categorie</label>
                            <select class="form-select @error('categorie') is-invalid @enderror" 
                                    id="categorie" name="categorie" required>
                                <option value="">Selecteer een categorie</option>
                                <option value="Knipbehandelingen" {{ old('categorie', $behandeling->categorie) == 'Knipbehandelingen' ? 'selected' : '' }}>Knipbehandelingen</option>
                                <option value="Kleurbehandelingen" {{ old('categorie', $behandeling->categorie) == 'Kleurbehandelingen' ? 'selected' : '' }}>Kleurbehandelingen</option>
                                <option value="Styling" {{ old('categorie', $behandeling->categorie) == 'Styling' ? 'selected' : '' }}>Styling</option>
                                <option value="Treatments" {{ old('categorie', $behandeling->categorie) == 'Treatments' ? 'selected' : '' }}>Treatments</option>
                            </select>
                            @error('categorie')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="naam" class="form-label">Naam</label>
                            <input type="text" class="form-control @error('naam') is-invalid @enderror" 
                                   id="naam" name="naam" value="{{ old('naam', $behandeling->naam) }}" required>
                            @error('naam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="beschrijving" class="form-label">Beschrijving</label>
                            <textarea class="form-control @error('beschrijving') is-invalid @enderror" 
                                      id="beschrijving" name="beschrijving" rows="3" required>{{ old('beschrijving', $behandeling->beschrijving) }}</textarea>
                            @error('beschrijving')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prijs" class="form-label">Basis Prijs Behandeling (€)</label>
                            <input type="number" class="form-control" id="prijs" name="prijs" 
                                   value="{{ $behandeling->prijs }}" step="0.01" min="0" required 
                                   onchange="updateTotalPrice()">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Benodigde Producten</label>
                            <div class="product-selection">
                                @foreach($producten as $product)
                                <div class="product-item mb-2">
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input" type="checkbox" 
                                               name="product_ids[]" 
                                               value="{{ $product->product_id }}"
                                               onchange="updateTotalPrice()"
                                               data-price="{{ $product->prijs }}"
                                               {{ $behandeling->products->contains($product->product_id) ? 'checked' : '' }}>
                                        <label class="form-check-label ms-2">
                                            {{ $product->naam }} (€{{ number_format($product->prijs, 2) }})
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Totaalprijs (incl. producten)</label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input type="text" class="form-control" id="totaalprijs" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="duur_minuten" class="form-label">Duur (minuten)</label>
                            <input type="number" class="form-control @error('duur_minuten') is-invalid @enderror" 
                                   id="duur_minuten" name="duur_minuten" value="{{ old('duur_minuten', $behandeling->duur_minuten) }}" required>
                            @error('duur_minuten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Specialisten</label>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="medewerker_1" 
                                               name="medewerker_ids[]" value="1"
                                               {{ in_array(1, $behandeling->medewerkers->pluck('medewerker_id')->toArray()) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="medewerker_1">
                                            Oumnia
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="medewerker_2" 
                                               name="medewerker_ids[]" value="2"
                                               {{ in_array(2, $behandeling->medewerkers->pluck('medewerker_id')->toArray()) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="medewerker_2">
                                            Anna Fleur
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="medewerker_3" 
                                               name="medewerker_ids[]" value="3"
                                               {{ in_array(3, $behandeling->medewerkers->pluck('medewerker_id')->toArray()) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="medewerker_3">
                                            Nazli
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="medewerker_4" 
                                               name="medewerker_ids[]" value="4"
                                               {{ in_array(4, $behandeling->medewerkers->pluck('medewerker_id')->toArray()) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="medewerker_4">
                                            Jan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @error('medewerker_ids')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input @error('is_populair') is-invalid @enderror" 
                                       id="is_populair" name="is_populair" value="1" 
                                       {{ old('is_populair', $behandeling->is_populair) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_populair">
                                    <i class="fas fa-fire text-danger"></i> Markeer als populaire behandeling
                                </label>
                                @error('is_populair')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
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

<script>
function updateTotalPrice() {
    // Basis behandelingsprijs ophalen
    let basisPrijs = parseFloat(document.getElementById('prijs').value) || 0;
    
    // Alle aangevinkte producten ophalen en prijzen optellen
    let productPrijzen = 0;
    document.querySelectorAll('input[name="product_ids[]"]:checked').forEach(checkbox => {
        productPrijzen += parseFloat(checkbox.dataset.price);
    });
    
    // Totaalprijs berekenen en weergeven
    let totaal = basisPrijs + productPrijzen;
    document.getElementById('totaalprijs').value = '€ ' + totaal.toFixed(2);
}

// Initiële berekening bij het laden van de pagina
document.addEventListener('DOMContentLoaded', function() {
    updateTotalPrice();
});
</script>
@endsection 