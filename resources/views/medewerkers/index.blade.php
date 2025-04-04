@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="position-relative mb-5">
                <div class="w-100 hero-banner">
                    <div class="position-absolute" style="top: 50%; left: 5%; transform: translateY(-50%);">
                        <h1 class="text-white display-4 fw-bold">Prijzen en<br>behandelingen</h1>
                        <p class="text-white-50 lead mb-0">Ontdek onze professionele behandelingen</p>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-4">
                <p class="lead text-muted text-center">
                    Bij The Hair Hub gaat trendy haarmode hand in hand met de traditionele waarden van een echt familiebedrijf. 
                    Of je nu komt voor een complete metamorfose of voor een vertrouwde coupe, in onze salons geniet elke klant van 
                    de persoonlijke aandacht van betrokken en gepassioneerde medewerkers.
                </p>
            </div>

            <!-- Populaire Behandelingen -->
            <div class="luxury-card mb-5">
                <div class="card-header-luxury">
                    <h3 class="text-gold mb-0"><i class="fas fa-fire text-gold me-2"></i>Populaire Behandelingen</h3>
                </div>
                <div class="card-body">
                    @php
                        $populaireBehandelingen = $behandelingen->where('is_populair', true);
                    @endphp
                    @if($populaireBehandelingen->isEmpty())
                        <p class="text-muted text-center">Er zijn nog geen populaire behandelingen gemarkeerd.</p>
                    @else
                        <div class="row">
                            @foreach($populaireBehandelingen as $behandeling)
                                <div class="col-md-4 mb-4">
                                    <div class="treatment-card">
                                        <div class="treatment-card-body">
                                            <h5 class="card-title">
                                                <i class="fas fa-fire text-gold me-2"></i>
                                                {{ $behandeling->naam }}
                                                <span class="badge bg-gold ms-2">{{ $behandeling->categorie }}</span>
                                            </h5>
                                            <p class="card-text">{{ $behandeling->beschrijving }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted"><i class="far fa-clock"></i> {{ $behandeling->duur_minuten }} min</span>
                                                <span class="price">€ {{ number_format($behandeling->prijs, 2, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            @auth
            <div class="mb-4 text-center">
                <button type="button" class="btn btn-gold" data-bs-toggle="modal" data-bs-target="#addBehandelingModal">
                    <i class="fas fa-plus"></i> Nieuwe Behandeling
                </button>
            </div>
            @endauth

            <!-- Display Behandelingen -->
            @foreach(['Knipbehandelingen', 'Kleurbehandelingen', 'Styling', 'Treatments'] as $categorie)
            <div class="luxury-card mb-5">
                <div class="card-header-luxury d-flex justify-content-between align-items-center">
                    <h3 class="text-gold mb-0">
                        <i class="fas {{ $categorie == 'Knipbehandelingen' ? 'fa-cut' : ($categorie == 'Kleurbehandelingen' ? 'fa-paint-brush' : ($categorie == 'Styling' ? 'fa-wind' : 'fa-spa')) }} me-2"></i>
                        {{ $categorie }}
                    </h3>
                </div>
                <div class="card-body">
                    @php
                        $behandelingenInCategorie = $behandelingen->where('categorie', $categorie);
                    @endphp
                    @if($behandelingenInCategorie->isEmpty())
                        <p class="text-muted text-center">Geen {{ strtolower($categorie) }} gevonden.</p>
                    @else
                        <div class="row" id="{{ Str::slug($categorie) }}">
                        @foreach($behandelingenInCategorie as $behandeling)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="treatment-card">
                                <div class="treatment-card-body">
                                    <h5 class="card-title">
                                        <i class="fas {{ $categorie == 'Knipbehandelingen' ? 'fa-cut' : ($categorie == 'Kleurbehandelingen' ? 'fa-paint-brush' : ($categorie == 'Styling' ? 'fa-wind' : 'fa-spa')) }} me-2 text-gold"></i>
                                        {{ $behandeling->naam }}
                                        @if($behandeling->is_populair)
                                            <span class="badge bg-gold ms-2">
                                                <i class="fas fa-fire"></i> Populair
                                            </span>
                                        @endif
                                    </h5>
                                    <p class="card-text">{{ $behandeling->beschrijving }}</p>
                                    <div class="treatment-details">
                                        <span class="duration"><i class="far fa-clock"></i> {{ $behandeling->duur_minuten }} min</span>
                                        @if($behandeling->medewerkers->isNotEmpty())
                                        <span class="specialists">
                                            <i class="fas fa-user-md"></i> 
                                            {{ $behandeling->medewerkers->pluck('naam')->implode(', ') }}
                                        </span>
                                        @endif
                                    </div>

                                    @if($behandeling->products->isNotEmpty())
                                    <div class="products-used mt-2">
                                        <small class="text-muted">Gebruikte producten:</small>
                                        @foreach($behandeling->products as $product)
                                            <div class="product-item">
                                                <small>• {{ $product->naam }} (+€{{ number_format($product->prijs, 2) }})</small>
                                            </div>
                                        @endforeach
                                    </div>
                                    @endif

                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div class="price-details">
                                            <span class="base-price">Behandeling: €{{ number_format($behandeling->prijs, 2) }}</span><br>
                                            @if($behandeling->products->isNotEmpty())
                                                <span class="products-total">Producten: €{{ number_format($behandeling->products->sum('prijs'), 2) }}</span><br>
                                                <span class="total-price fw-bold">Totaal: €{{ number_format($behandeling->prijs + $behandeling->products->sum('prijs'), 2) }}</span>
                                            @else
                                                <span class="no-products text-muted"><i class="fas fa-info-circle"></i> Geen extra producten</span><br>
                                                <span class="total-price fw-bold">Totaal: €{{ number_format($behandeling->prijs, 2) }}</span>
                                            @endif
                                        </div>
                                        @auth
                                        <div class="btn-group">
                                            <a href="{{ route('medewerkers.behandeling.edit', $behandeling->behandeling_id) }}" class="btn btn-sm btn-outline-gold">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('medewerkers.behandeling.delete', $behandeling->behandeling_id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Weet u zeker dat u de behandeling \'{{ $behandeling->naam }}\' wilt verwijderen?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        </div>
                    @endif
                </div>
            </div>
            @endforeach

            <!-- Beschikbare Producten -->
            <div class="luxury-card mb-5">
                <div class="card-header-luxury">
                    <h3 class="text-gold mb-0">
                        <i class="fas fa-box-open me-2"></i>
                        Productoverzicht
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($producten ?? [] as $product)
                        <div class="col-md-4 mb-4">
                            <div class="product-card bg-white rounded shadow-sm p-3">
                                <div class="product-image mb-3">
                                    @if($product->naam === 'Kerastase Shampoo')
                                        <img src="{{ asset('images/shampoo.png') }}" alt="{{ $product->naam }}" class="img-fluid" style="width: 100%; height: 300px; object-fit: contain;">
                                    @elseif($product->naam === 'Redken Conditioner')
                                        <img src="{{ asset('images/redkan.png') }}" alt="{{ $product->naam }}" class="img-fluid" style="width: 100%; height: 300px; object-fit: contain;">
                                    @elseif($product->naam === "L'Oreal Hair Color")
                                        <img src="{{ asset('images/haircolor.png') }}" alt="{{ $product->naam }}" class="img-fluid" style="width: 100%; height: 300px; object-fit: contain;">
                                    @elseif($product->naam === 'Wella Hairspray')
                                        <img src="{{ asset('images/hairspray.png') }}" alt="{{ $product->naam }}" class="img-fluid" style="width: 100%; height: 300px; object-fit: contain;">
                                    @elseif($product->naam === 'Kérastase Hair Mask')
                                        <img src="{{ asset('images/hairmask.png') }}" alt="{{ $product->naam }}" class="img-fluid" style="width: 100%; height: 300px; object-fit: contain;">
                                    @elseif($product->naam === 'Redken Heat Protect')
                                        <img src="{{ asset('images/heat.png') }}" alt="{{ $product->naam }}" class="img-fluid" style="width: 100%; height: 300px; object-fit: contain;">
                                    @else
                                        <img src="{{ asset('images/default-product.jpg') }}" alt="{{ $product->naam }}" class="img-fluid" style="width: 100%; height: 300px; object-fit: contain;">
                                    @endif
                                </div>
                                <h5 class="product-title mb-2">{{ $product->naam }}</h5>
                                <p class="product-description text-muted mb-3">{{ $product->beschrijving }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="product-price fw-bold">€ {{ number_format($product->prijs, 2, ',', '.') }}</span>
                                    <span class="badge bg-purple px-3 py-2">
                                        <i class="fas fa-check me-1"></i>
                                        Voorraad: {{ $product->voorraad }}
                                    </span>
                                </div>
                                @if(Auth::user() && Auth::user()->medewerker && Auth::user()->medewerker->eigenaar_id === null)
                                <div class="product-actions mt-3 text-end">
                                    <button class="btn btn-sm btn-outline-gold me-2" onclick="editProduct({{ $product->product_id }})">
                                        <i class="fas fa-edit"></i> Bewerken
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteProduct({{ $product->product_id }})">
                                        <i class="fas fa-trash"></i> Verwijderen
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center text-muted">
                            <p>Er zijn nog geen producten toegevoegd.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="row mt-5">
        <div class="col-12 text-center mb-4">
            <h2 class="section-title" style="color: #4169E1;">Ons Team</h2>
            <p class="text-muted">Ontmoet onze ervaren stylisten</p>
        </div>
        <!-- Oumnia -->
        <div class="col-md-3">
            <div class="text-center">
                <img src="{{ asset('images/oumnia.jpg') }}" alt="Oumnia" class="img-fluid" style="width: 100%; height: 400px; object-fit: cover;">
                <h5 class="mt-3 mb-2">Oumnia</h5>
                <div>
                    <span class="badge rounded-pill" style="background-color: #4169E1;">Punten Knippen</span>
                    <span class="badge rounded-pill" style="background-color: #4169E1;">Haarverzorging</span>
                    <span class="badge rounded-pill" style="background-color: #4169E1;">Styling</span>
                </div>
            </div>
        </div>

        <!-- Anna Fleur -->
        <div class="col-md-3">
            <div class="text-center">
                <img src="{{ asset('images/annafleur.jpg') }}" alt="Anna Fleur" class="img-fluid" style="width: 100%; height: 400px; object-fit: cover;">
                <h5 class="mt-3 mb-2">Anna Fleur</h5>
                <div>
                    <span class="badge rounded-pill" style="background-color: #4169E1;">Kleuren</span>
                    <span class="badge rounded-pill" style="background-color: #4169E1;">Highlights</span>
                    <span class="badge rounded-pill" style="background-color: #4169E1;">Balayage</span>
                </div>
            </div>
        </div>

        <!-- Nazli -->
        <div class="col-md-3">
            <div class="text-center">
                <img src="{{ asset('images/nazli.png') }}" alt="Nazli" class="img-fluid" style="width: 100%; height: 400px; object-fit: cover;">
                <h5 class="mt-3 mb-2">Nazli</h5>
                <div>
                    <span class="badge rounded-pill" style="background-color: #4169E1;">Dames Knippen</span>
                    <span class="badge rounded-pill" style="background-color: #4169E1;">Föhnen</span>
                    <span class="badge rounded-pill" style="background-color: #4169E1;">Opsteken</span>
                </div>
            </div>
        </div>

        <!-- Jan -->
        <div class="col-md-3">
            <div class="text-center">
                <img src="{{ asset('images/jan.jpg') }}" alt="Jan" class="img-fluid" style="width: 100%; height: 400px; object-fit: cover;">
                <h5 class="mt-3 mb-2">Jan</h5>
                <div>
                    <span class="badge rounded-pill" style="background-color: #4169E1;">Knippen</span>
                    <span class="badge rounded-pill" style="background-color: #4169E1;">Kleuren</span>
                    <span class="badge rounded-pill" style="background-color: #4169E1;">Treatments</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Treatment Modal -->
<div class="modal fade" id="addBehandelingModal" tabindex="-1" aria-labelledby="addBehandelingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBehandelingModalLabel">Nieuwe Behandeling Toevoegen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('medewerkers.behandeling.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="categorie" class="form-label">Categorie</label>
                        <select class="form-select" id="categorie" name="categorie" required>
                            <option value="">Selecteer een categorie</option>
                            <option value="Knipbehandelingen">Knipbehandelingen</option>
                            <option value="Kleurbehandelingen">Kleurbehandelingen</option>
                            <option value="Styling">Styling</option>
                            <option value="Treatments">Treatments</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="naam" class="form-label">Naam</label>
                        <input type="text" class="form-control" id="naam" name="naam" required>
                    </div>
                    <div class="mb-3">
                        <label for="beschrijving" class="form-label">Beschrijving</label>
                        <textarea class="form-control" id="beschrijving" name="beschrijving" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="prijs" class="form-label">Basis Prijs Behandeling (€)</label>
                        <input type="number" class="form-control" id="prijs" name="prijs" step="0.01" min="0" required onchange="updateTotalPrice()">
                    </div>
                    <div class="mb-3">
                        <label for="duur_minuten" class="form-label">Duur (minuten)</label>
                        <input type="number" class="form-control" id="duur_minuten" name="duur_minuten" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Specialisten</label>
                        <div class="row g-3">
                            @foreach($medewerkers as $medewerker)
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" 
                                           id="medewerker_{{ $medewerker->medewerker_id }}" 
                                           name="medewerker_ids[]" 
                                           value="{{ $medewerker->medewerker_id }}">
                                    <label class="form-check-label" for="medewerker_{{ $medewerker->medewerker_id }}">
                                        {{ $medewerker->naam }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
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
                                           data-price="{{ $product->prijs }}">
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
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_populair" name="is_populair" value="1">
                            <label class="form-check-label" for="is_populair">
                                Markeer als populaire behandeling
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuleren</button>
                    <button type="submit" class="btn btn-gold">Behandeling Toevoegen</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- New Product Modal -->
<div class="modal fade" id="newProductModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content luxury-modal">
            <div class="modal-header">
                <h5 class="modal-title text-gold">Nieuw Product Toevoegen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="newProductForm" action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="product_naam" class="form-label">Naam</label>
                        <input type="text" class="form-control luxury-input" id="product_naam" name="naam" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_beschrijving" class="form-label">Beschrijving</label>
                        <textarea class="form-control luxury-input" id="product_beschrijving" name="beschrijving" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="product_prijs" class="form-label">Prijs (€)</label>
                        <input type="number" class="form-control luxury-input" id="product_prijs" name="prijs" step="0.01" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_voorraad" class="form-label">Voorraad</label>
                        <input type="number" class="form-control luxury-input" id="product_voorraad" name="voorraad" min="0" required>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuleren</button>
                        <button type="submit" class="btn btn-gold">Toevoegen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content luxury-modal">
            <div class="modal-header">
                <h5 class="modal-title text-gold">Product Bewerken</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="edit_product_naam" class="form-label">Naam</label>
                        <input type="text" class="form-control luxury-input" id="edit_product_naam" name="naam" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_product_beschrijving" class="form-label">Beschrijving</label>
                        <textarea class="form-control luxury-input" id="edit_product_beschrijving" name="beschrijving" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_product_prijs" class="form-label">Prijs (€)</label>
                        <input type="number" class="form-control luxury-input" id="edit_product_prijs" name="prijs" step="0.01" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_product_voorraad" class="form-label">Voorraad</label>
                        <input type="number" class="form-control luxury-input" id="edit_product_voorraad" name="voorraad" min="0" required>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuleren</button>
                        <button type="submit" class="btn btn-gold">Opslaan</button>
                    </div>
                </form>
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

// Initiële berekening
updateTotalPrice();
</script>
@endsection

@section('scripts')
<script>
// Function to handle form submission
function handleFormSubmit(event, form) {
    event.preventDefault();
    
    const formData = new FormData(form);
    const method = form.getAttribute('method');
    const url = form.getAttribute('action');
    
    fetch(url, {
        method: method.toUpperCase(),
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Close any open modals
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            const bootstrapModal = bootstrap.Modal.getInstance(modal);
            if (bootstrapModal) {
                bootstrapModal.hide();
            }
        });
        
        // Show success message
        alert(data.message);
        
        // Reload the page to show updated products
        window.location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Er is een fout opgetreden. Probeer het opnieuw.');
    });
}

// Add event listeners to forms
document.addEventListener('DOMContentLoaded', function() {
    const newProductForm = document.getElementById('newProductForm');
    const editProductForm = document.getElementById('editProductForm');
    
    if (newProductForm) {
        newProductForm.addEventListener('submit', function(event) {
            handleFormSubmit(event, this);
        });
    }
    
    if (editProductForm) {
        editProductForm.addEventListener('submit', function(event) {
            handleFormSubmit(event, this);
        });
    }
});

function editProduct(productId) {
    fetch(`/products/${productId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(product => {
            document.getElementById('edit_product_naam').value = product.naam;
            document.getElementById('edit_product_beschrijving').value = product.beschrijving;
            document.getElementById('edit_product_prijs').value = product.prijs;
            document.getElementById('edit_product_voorraad').value = product.voorraad;
            
            const form = document.getElementById('editProductForm');
            form.action = `/products/${productId}`;
            
            // Add _method field for PUT request
            let methodInput = form.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                form.appendChild(methodInput);
            }
            methodInput.value = 'PUT';
            
            new bootstrap.Modal(document.getElementById('editProductModal')).show();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Er is een fout opgetreden bij het ophalen van de productgegevens.');
        });
}

function deleteProduct(productId) {
    if (confirm('Weet je zeker dat je dit product wilt verwijderen?')) {
        fetch(`/products/${productId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            alert(data.message);
            window.location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Er is een fout opgetreden bij het verwijderen van het product.');
        });
    }
}
</script>
@endsection

<!-- Add CSRF token meta tag in the head section -->
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('styles')
<style>
    .products-used {
        font-size: 0.9em;
        padding: 8px;
        background-color: #f8f9fa;
        border-radius: 4px;
    }

    .product-item {
        margin: 2px 0;
        color: #666;
    }

    .price-details {
        line-height: 1.4;
    }

    .base-price {
        color: #666;
    }

    .products-total {
        color: #666;
        font-size: 0.9em;
    }

    .total-price {
        color: #000;
        font-size: 1.1em;
    }

    /* Team Section Styling */
    .team-img {
        width: 100%;
        max-width: 300px;
        height: auto;
        aspect-ratio: 1;
        object-fit: cover;
        border-radius: 0;
    }

    .badge {
        font-weight: normal;
        padding: 8px 16px;
        font-size: 0.85rem;
    }

    h5 {
        font-weight: normal;
        margin-bottom: 0.5rem;
    }
</style>
@endsection




