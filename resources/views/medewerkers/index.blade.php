@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="position-relative mb-5">
                <div class="w-100" style="height: 300px; background: linear-gradient(135deg, #6B46C1 0%, #2C5282 100%); border-radius: 8px;">
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
                <p class="lead text-muted">
                    Bij The Hair Hub gaat trendy haarmode hand in hand met de traditionele waarden van een echt familiebedrijf. 
                    Of je nu komt voor een complete metamorfose of voor een vertrouwde coupe, in onze salons geniet elke klant van 
                    de persoonlijke aandacht van betrokken en gepassioneerde medewerkers.
                </p>
            </div>

            @auth
            <div class="mb-4">
                <button type="button" class="btn btn-custom-purple" data-bs-toggle="modal" data-bs-target="#addBehandelingModal">
                    <i class="fas fa-plus"></i> Nieuwe Behandeling
                </button>
            </div>
            @endauth

            <!-- Knipbehandelingen -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="text-purple mb-0"><i class="fas fa-cut me-2"></i>Knipbehandelingen</h3>
                </div>
                <div class="card-body">
                    @php
                        $knipbehandelingen = $behandelingen->where('categorie', 'Knipbehandelingen');
                    @endphp
                    @if($knipbehandelingen->isEmpty())
                        <p class="text-muted">Geen knipbehandelingen gevonden.</p>
                    @else
                        @foreach($knipbehandelingen as $behandeling)
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div>
                                <h5 class="mb-0"><i class="fas fa-cut me-2 text-secondary"></i>{{ $behandeling->naam }}</h5>
                                <small class="text-muted">{{ $behandeling->beschrijving }}</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="me-3">€ {{ number_format($behandeling->prijs, 2, ',', '.') }}</span>
                                @auth
                                <div class="btn-group">
                                    <a href="{{ route('medewerkers.behandeling.edit', $behandeling->behandeling_id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('medewerkers.behandeling.delete', $behandeling->behandeling_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Weet u zeker dat u de behandeling \'{{ $behandeling->naam }}\' wilt verwijderen?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                @endauth
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Kleurbehandelingen -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="text-purple mb-0"><i class="fas fa-paint-brush me-2"></i>Kleurbehandelingen</h3>
                </div>
                <div class="card-body">
                    @php
                        $kleurbehandelingen = $behandelingen->where('categorie', 'Kleurbehandelingen');
                    @endphp
                    @if($kleurbehandelingen->isEmpty())
                        <p class="text-muted">Geen kleurbehandelingen gevonden.</p>
                    @else
                        @foreach($kleurbehandelingen as $behandeling)
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div>
                                <h5 class="mb-0"><i class="fas fa-paint-brush me-2 text-secondary"></i>{{ $behandeling->naam }}</h5>
                                <small class="text-muted">{{ $behandeling->beschrijving }}</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="me-3">€ {{ number_format($behandeling->prijs, 2, ',', '.') }}</span>
                                @auth
                                <div class="btn-group">
                                    <a href="{{ route('medewerkers.behandeling.edit', $behandeling->behandeling_id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('medewerkers.behandeling.delete', $behandeling->behandeling_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Weet u zeker dat u de behandeling \'{{ $behandeling->naam }}\' wilt verwijderen?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                @endauth
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Styling -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="text-purple mb-0"><i class="fas fa-wind me-2"></i>Styling</h3>
                </div>
                <div class="card-body">
                    @php
                        $styling = $behandelingen->where('categorie', 'Styling');
                    @endphp
                    @if($styling->isEmpty())
                        <p class="text-muted">Geen styling behandelingen gevonden.</p>
                    @else
                        @foreach($styling as $behandeling)
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div>
                                <h5 class="mb-0"><i class="fas fa-wind me-2 text-secondary"></i>{{ $behandeling->naam }}</h5>
                                <small class="text-muted">{{ $behandeling->beschrijving }}</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="me-3">€ {{ number_format($behandeling->prijs, 2, ',', '.') }}</span>
                                @auth
                                <div class="btn-group">
                                    <a href="{{ route('medewerkers.behandeling.edit', $behandeling->behandeling_id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('medewerkers.behandeling.delete', $behandeling->behandeling_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Weet u zeker dat u de behandeling \'{{ $behandeling->naam }}\' wilt verwijderen?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                @endauth
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Treatments -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="text-purple mb-0"><i class="fas fa-spa me-2"></i>Treatments</h3>
                </div>
                <div class="card-body">
                    @php
                        $treatments = $behandelingen->where('categorie', 'Treatments');
                    @endphp
                    @if($treatments->isEmpty())
                        <p class="text-muted">Geen treatments gevonden.</p>
                    @else
                        @foreach($treatments as $behandeling)
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div>
                                <h5 class="mb-0"><i class="fas fa-spa me-2 text-secondary"></i>{{ $behandeling->naam }}</h5>
                                <small class="text-muted">{{ $behandeling->beschrijving }}</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="me-3">€ {{ number_format($behandeling->prijs, 2, ',', '.') }}</span>
                                @auth
                                <div class="btn-group">
                                    <a href="{{ route('medewerkers.behandeling.edit', $behandeling->behandeling_id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('medewerkers.behandeling.delete', $behandeling->behandeling_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Weet u zeker dat u de behandeling \'{{ $behandeling->naam }}\' wilt verwijderen?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                @endauth
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal voor nieuwe behandeling -->
<div class="modal fade" id="addBehandelingModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nieuwe Behandeling</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('medewerkers.behandeling.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Categorie</label>
                        <select class="form-control" name="categorie" required>
                            <option value="Knipbehandelingen">Knipbehandelingen</option>
                            <option value="Kleurbehandelingen">Kleurbehandelingen</option>
                            <option value="Styling">Styling</option>
                            <option value="Treatments">Treatments</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Naam</label>
                        <input type="text" class="form-control" name="naam" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Beschrijving</label>
                        <textarea class="form-control" name="beschrijving" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prijs (€)</label>
                        <input type="number" step="0.01" class="form-control" name="prijs" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Duur (minuten)</label>
                        <input type="number" class="form-control" name="duur_minuten" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuleren</button>
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.text-purple {
    color: #6B46C1;
}

.btn-custom-purple {
    background-color: #6B46C1;
    border-color: #6B46C1;
    color: white;
}

.btn-custom-purple:hover {
    background-color: #553C9A;
    border-color: #553C9A;
    color: white;
}

.btn-custom-purple:focus {
    background-color: #553C9A;
    border-color: #553C9A;
    color: white;
    box-shadow: 0 0 0 0.25rem rgba(107, 70, 193, 0.25);
}
</style>
@endsection

