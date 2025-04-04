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
                <div class="card-header-luxury">
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
                        <div class="row" id="{{ strtolower(str_replace('behandelingen', '', $categorie)) }}-container">
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
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="price">€ {{ number_format($behandeling->prijs, 2, ',', '.') }}</span>
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
        </div>
    </div>

    <!-- Team Section -->
    <div class="row mt-5">
        <div class="col-12 text-center mb-4">
            <h2 class="section-title">Ons Team</h2>
        </div>
        <!-- Mo -->
        <div class="col-md-3">
            <div class="team-member">
                <div class="team-photo">
                    <img src="{{ asset('images/oumnia.jpg') }}" alt="Mo" class="img-fluid rounded">
                </div>
                <div class="team-details mt-3">
                    <h4 class="team-name">oumnia</h4>
                    <div class="team-specialties">
                        <span class="badge bg-purple">punten Knippen</span>
                        <span class="badge bg-purple">haarverzorging</span>
                        <span class="badge bg-purple">Styling</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Badr -->
        <div class="col-md-3">
            <div class="team-member">
                <div class="team-photo">
                    <img src="{{ asset('images/annafleur.jpg') }}" alt="Anna Fleur" class="img-fluid rounded">
                </div>
                <div class="team-details mt-3">
                    <h4 class="team-name">Anna Fleur</h4>
                    <div class="team-specialties">
                        <span class="badge bg-purple">Kleuren</span>
                        <span class="badge bg-purple">Highlights</span>
                        <span class="badge bg-purple">Balayage</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Nazli -->
        <div class="col-md-3">
            <div class="team-member">
                <div class="team-photo">
                    <img src="{{ asset('images/nazli.png') }}" alt="Nazli" class="img-fluid rounded">
                </div>
                <div class="team-details mt-3">
                    <h4 class="team-name">Nazli</h4>
                    <div class="team-specialties">
                        <span class="badge bg-purple">Dames Knippen</span>
                        <span class="badge bg-purple">Föhnen</span>
                        <span class="badge bg-purple">Opsteken</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jan -->
        <div class="col-md-3">
            <div class="team-member">
                <div class="team-photo">
                    <img src="{{ asset('images/jan.jpg') }}" alt="Jan" class="img-fluid rounded">
                </div>
                <div class="team-details mt-3">
                    <h4 class="team-name">Jan</h4>
                    <div class="team-specialties">
                        <span class="badge bg-purple">Knippen</span>
                        <span class="badge bg-purple">Kleuren</span>
                        <span class="badge bg-purple">Treatments</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Behandeling Modal -->
<div class="modal fade" id="addBehandelingModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content luxury-modal">
            <div class="modal-header">
                <h5 class="modal-title text-gold">Nieuwe Behandeling Toevoegen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addBehandelingForm" action="{{ route('medewerkers.behandeling.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="categorie" class="form-label">Categorie</label>
                        <select class="form-select luxury-select" id="categorie" name="categorie" required>
                            <option value="">Selecteer een categorie</option>
                            <option value="Knipbehandelingen">Knipbehandelingen</option>
                            <option value="Kleurbehandelingen">Kleurbehandelingen</option>
                            <option value="Styling">Styling</option>
                            <option value="Treatments">Treatments</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="naam" class="form-label">Naam</label>
                        <input type="text" class="form-control luxury-input" id="naam" name="naam" required>
                    </div>
                    <div class="mb-3">
                        <label for="beschrijving" class="form-label">Beschrijving</label>
                        <textarea class="form-control luxury-input" id="beschrijving" name="beschrijving" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="prijs" class="form-label">Prijs (€)</label>
                        <input type="number" class="form-control luxury-input" id="prijs" name="prijs" step="0.01" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="duur_minuten" class="form-label">Duur (minuten)</label>
                        <input type="number" class="form-control luxury-input" id="duur_minuten" name="duur_minuten" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Specialisten</label>
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="form-check luxury-checkbox">
                                    <input type="checkbox" class="form-check-input" id="medewerker_1" name="medewerker_ids[]" value="1">
                                    <label class="form-check-label" for="medewerker_1">Oumnia</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check luxury-checkbox">
                                    <input type="checkbox" class="form-check-input" id="medewerker_2" name="medewerker_ids[]" value="2">
                                    <label class="form-check-label" for="medewerker_2">Anna Fleur</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check luxury-checkbox">
                                    <input type="checkbox" class="form-check-input" id="medewerker_3" name="medewerker_ids[]" value="3">
                                    <label class="form-check-label" for="medewerker_3">Nazli</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check luxury-checkbox">
                                    <input type="checkbox" class="form-check-input" id="medewerker_4" name="medewerker_ids[]" value="4">
                                    <label class="form-check-label" for="medewerker_4">Jan</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check luxury-checkbox">
                            <input type="checkbox" class="form-check-input" id="is_populair" name="is_populair" value="1">
                            <label class="form-check-label" for="is_populair">
                                <i class="fas fa-fire text-gold"></i> Markeer als populaire behandeling
                            </label>
                        </div>
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

<style>
.section-title {
    color: var(--primary-purple);
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 2rem;
}

.team-member {
    text-align: center;
    margin-bottom: 2rem;
    padding: 1rem;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.team-member:hover {
    transform: translateY(-5px);
}

.team-photo {
    width: 200px;
    height: 200px;
    margin: 0 auto 1rem;
    overflow: hidden;
    border-radius: 10px;
}

.team-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.team-name {
    color: var(--primary-purple);
    font-size: 1.2rem;
    margin-bottom: 1rem;
}

.team-specialties {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    justify-content: center;
}

.badge.bg-purple {
    background-color: var(--primary-purple);
    color: white;
    font-weight: normal;
    padding: 0.5em 1em;
}
</style>
@endsection

@section('scripts')
@endsection

